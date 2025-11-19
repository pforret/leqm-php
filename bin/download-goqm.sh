#!/usr/bin/env bash
#
# Download goqm binaries from GitHub
#

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
REPO_URL="https://raw.githubusercontent.com/pforret/leqm-nrt/master/build"

BINARIES=(
    "goqm_linux"
    "goqm_macos"
    "goqm_macos_arm"
    "goqm_win.exe"
)

echo "Downloading goqm binaries to $SCRIPT_DIR"

for binary in "${BINARIES[@]}"; do
    echo "  Downloading $binary..."
    curl -fsSL "$REPO_URL/$binary" -o "$SCRIPT_DIR/$binary"
    chmod +x "$SCRIPT_DIR/$binary"
done

echo "Done. Downloaded ${#BINARIES[@]} binaries."
