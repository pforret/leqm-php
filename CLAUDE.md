# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

PHP library for LEQ(m) audio loudness measurement. Wraps the goqm binary from https://github.com/pforret/leqm-nrt to analyze audio files and return structured JSON results.

## Development Commands

```bash
# Install dependencies
composer install

# Run tests
composer test

# Run code style fixer
composer lint

# Download goqm binaries
./bin/download-goqm.sh
```

## Architecture

### Namespace
`Pforret\LeqmPhp` (PSR-4 autoloaded from `src/`)

### Core Classes

- **LeqmPhp** (`src/LeqmPhp.php`) - Main class that detects OS, selects binary, executes measurement
- **LeqmResult** (`src/LeqmResult.php`) - Result object with accessors for all JSON fields (metadata, measurements, channel stats, execution info)

### Exceptions

- **LeqmException** - Base exception
- **BinaryNotFoundException** - Binary not found or not executable
- **MeasurementException** - File not found or measurement failed

### Binary Detection

LeqmPhp auto-detects the correct binary based on:
- `PHP_OS_FAMILY`: Darwin, Linux, Windows
- `php_uname('m')`: arm64 vs x86_64 for macOS

Binaries in `bin/`:
- `goqm_macos_arm` - macOS ARM (M1/M2)
- `goqm_macos` - macOS Intel
- `goqm_linux` - Linux
- `goqm_win.exe` - Windows

## Testing

Tests use Pest framework and require goqm binaries to be downloaded first.

Test files in `media/`:
- `test1.wav` - Stereo 16-bit
- `test2.wav` - Stereo 16-bit
- `test3.wav` - 7.1 surround 24-bit
- `test4.wav` - 5.1 surround 24-bit

Each has a corresponding `.md` file with ffprobe and goqm output.

## Key Concepts

### LEQ(m) Measurement Output
- `leq_m`: Main loudness measurement in dB (M-weighted)
- `leq_no_weight`: Unweighted Leq in dB
- `mean_power` / `mean_power_weighted`: Power values
- `channel_stats`: Array with peak_db and average_db per channel
- `metadata`: File info (duration, sample rate, channels, frames)
- `execution`: Processing time, binary version, speed index

## Documentation

MkDocs Material site in `docs/`. README.md symlinks to `docs/index.md`.

```bash
mkdocs serve   # Local preview
mkdocs build   # Build static site
```
