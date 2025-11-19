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
- **LeqmResult** (`src/LeqmResult.php`) - Readonly DTO with nested DTOs for structured access

### DTO Classes (`src/DTO/`)

- **Metadata** - File info (file, sampleRate, channels, frames, durationSeconds)
- **Measurements** - Loudness values (leqM, leqNoWeight, meanPower, meanPowerWeighted)
- **ChannelStat** - Per-channel stats (channel, peakDb, averageDb)
- **Execution** - Processing info (binaryPath, binaryVersion, executionSeconds, speedIndex, mbps)

All DTOs are `readonly` classes with:
- Public properties for direct access
- Static `fromArray()` factory methods
- `toArray()` serialization methods

### Exceptions (`src/Exceptions/`)

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

Access via DTO properties:
```php
$result->measurements->leqM;           // Main loudness in dB
$result->measurements->leqNoWeight;    // Unweighted Leq
$result->metadata->durationSeconds;    // Duration
$result->channelStats[0]->peakDb;      // Channel peak
$result->execution->binaryVersion;     // Binary version
```

Or convenience getters:
```php
$result->getLeqM();
$result->getDuration();
$result->getChannelPeakDb(0);
```

## Documentation

MkDocs Material site in `docs/`. README.md symlinks to `docs/index.md`.

```bash
mkdocs serve   # Local preview
mkdocs build   # Build static site
```
