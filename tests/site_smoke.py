#!/usr/bin/env python3
"""Check that the standalone Handbook deploys and every bilingual page renders.

No external dependencies and no live-grid credentials are required.
"""
import json
import subprocess
import sys
import time
from html.parser import HTMLParser
from pathlib import Path
from urllib.error import URLError, HTTPError
from urllib.parse import urljoin, urlparse, unquote
from urllib.request import urlopen

ROOT = Path(__file__).resolve().parents[1]
HOST = "http://127.0.0.1:18973/"

class Assets(HTMLParser):
    def __init__(self):
        super().__init__()
        self.refs = set()

    def handle_starttag(self, tag, attrs):
        if tag in ("a", "link", "script", "img"):
            data = dict(attrs)
            target = data.get("href") or data.get("src")
            if target:
                self.refs.add(target)

def catalog():
    p = subprocess.run(
        ["php", "-r", "require 'inc/site.php'; echo json_encode(handbook_groups(), JSON_UNESCAPED_UNICODE);"],
        cwd=ROOT, capture_output=True, text=True, check=True,
    )
    groups = json.loads(p.stdout)
    if len(groups) < 1:
        raise AssertionError("No handbook groups found")
    pages = [row[0] for group in groups for row in group[3]]
    if len(pages) != len(set(pages)):
        raise AssertionError("Duplicate page in handbook_groups()")
    present = {p.stem for p in ROOT.glob("*.php") if p.stem != "index"}
    if set(pages) != present:
        raise AssertionError("Catalog mismatch: missing=" + repr(sorted(present-set(pages)))
                             + " unexpected=" + repr(sorted(set(pages)-present)))
    return ["index"] + pages, groups

def response(url):
    with urlopen(url, timeout=18) as stream:
        content = stream.read()
        status = stream.status
        return status, content

def main():
    pages, groups = catalog()
    if not (ROOT / "INI.CSV").is_file():
        raise AssertionError("INI.CSV is required at repository root")
    if not (ROOT / "data" / "ossl-functions.json").is_file():
        raise AssertionError("OSSL JSON dataset is missing")
    server = subprocess.Popen(
        ["php", "-S", "127.0.0.1:18973", "-t", str(ROOT)],
        cwd=ROOT, stdout=subprocess.DEVNULL, stderr=subprocess.PIPE,
    )
    try:
        for _ in range(40):
            try:
                response(HOST + "index.php?lang=fr")
                break
            except (URLError, ConnectionError, HTTPError):
                time.sleep(0.15)
        else:
            raise AssertionError("PHP server did not start")
        checked = 0
        for page in pages:
            for language in ("fr", "en"):
                uri = HOST + page + ".php?lang=" + language
                status, content = response(uri)
                if status != 200:
                    raise AssertionError(f"HTTP {status} on {uri}")
                html = content.decode("utf-8")
                if "<html" not in html or "</html>" not in html:
                    raise AssertionError("Incomplete HTML: " + uri)
                if f'lang="{language}"' not in html:
                    raise AssertionError("Incorrect page language: " + uri)
                # CSV descriptions can legitimately contain “Warning:” in plain text.
                # Detect PHP runtime diagnostics without flagging quoted source data.
                for marker in ("PHP Warning:", "<b>Warning</b>:", "<b>Fatal error</b>:", "Fatal error:", "Parse error:", "Uncaught Error:"):
                    if marker in html:
                        raise AssertionError(f"{marker} in {uri}")
                # Editorial regression checks: user-facing titles must never contain
                # drafting instructions or leftover internal notes.
                from html.parser import HTMLParser as _HTMLParser
                class Headings(_HTMLParser):
                    def __init__(self):
                        super().__init__()
                        self.depth = 0
                        self.found = []
                    def handle_starttag(self, tag, attrs):
                        if tag in ("h1", "h2", "h3", "h4"):
                            self.depth += 1
                    def handle_endtag(self, tag):
                        if tag in ("h1", "h2", "h3", "h4") and self.depth:
                            self.depth -= 1
                    def handle_data(self, data):
                        if self.depth:
                            self.found.append(data)
                headings = Headings()
                headings.feed(html)
                for heading in headings.found:
                    if any(term in heading.casefold() for term in ("sans duplication", "no duplication", "ton fork", "your fork", "todo", "fixme")):
                        raise AssertionError(f"Editorial note in {uri}: {heading}")
                parser = Assets()
                parser.feed(html)
                for link in parser.refs:
                    parsed = urlparse(urljoin(uri, link))
                    if parsed.hostname not in ("127.0.0.1", "localhost") or parsed.port != 18973:
                        continue
                    rel = unquote(parsed.path.lstrip("/"))
                    target = ROOT / rel
                    if not target.is_file():
                        raise AssertionError(f"Broken internal link in {page}: {link}")
                checked += 1
        for asset in ("INI.CSV", "data/ossl-functions.json", "assets/site.css", "assets/site.js"):
            status, body = response(HOST + asset)
            if status != 200 or not body:
                raise AssertionError(f"Missing or empty {asset}")
        print(f"OK: {checked} bilingual page renders, {len(groups)} groups, {len(pages)} pages, internal links and assets.")
    finally:
        server.terminate()
        try:
            server.communicate(timeout=5)
        except subprocess.TimeoutExpired:
            server.kill()
            server.communicate(timeout=5)

if __name__ == "__main__":
    try:
        main()
    except Exception as exc:
        print(f"FAIL: {exc}", file=sys.stderr)
        sys.exit(1)
