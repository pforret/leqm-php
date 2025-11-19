# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

PHP library for audio loudness measurement using LEQ(m) algorithm. Wraps external binaries (leqm-nrt and goqm) from https://github.com/pforret/leqm-nrt to perform audio analysis via ffmpeg.

## Development Commands

```bash
# Install dependencies
composer install

# Run code style fixer
./vendor/bin/pint
```

## Architecture

- **Namespace**: `Pforret\LeqmPhp` (PSR-4 autoloaded from `src/`)
- **External binaries**: leqm-nrt (C, text output) and goqm (Go, JSON output)
- **Documentation**: MkDocs Material site in `docs/`

## Key Concepts

### LEQ(m) Measurement
- leqm-nrt: Original C binary, outputs text format with Leq(M) values
- goqm: Go version, outputs structured JSON with metadata, measurements, and channel stats

### Audio Analysis Output
- Leq(M): Main loudness measurement in dB
- Leq(no weight): Unweighted measurement
- Channel stats: Peak and average dB per channel
- True peak values (optional)

## Documentation

```bash
# Serve docs locally
mkdocs serve

# Build static site
mkdocs build
```
