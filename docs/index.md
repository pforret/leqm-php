# pforret/leqm-php

PHP library for LEQ(m) audio loudness measurement using the goqm binary.

## Requirements

- PHP 8.1+
- One of the supported platforms: macOS (Intel/ARM), Linux, or Windows

## Installation

```bash
composer require pforret/leqm-php
```

The goqm binaries for all platforms are included in the package.

## Usage

### Basic Measurement

```php
use Pforret\LeqmPhp\LeqmPhp;

$leqm = new LeqmPhp();
$result = $leqm->measure('/path/to/audio.wav');

echo "Leq(M): " . $result->getLeqM() . " dB\n";
echo "Duration: " . $result->getDuration() . " seconds\n";
```

### Accessing Measurements

The result is returned as a DTO with public properties:

```php
$result = $leqm->measure('/path/to/audio.wav');

// Direct property access (recommended)
$result->measurements->leqM;           // Leq(M) weighted loudness in dB
$result->measurements->leqNoWeight;    // Unweighted Leq in dB
$result->measurements->meanPower;      // Mean power
$result->measurements->meanPowerWeighted;

$result->metadata->file;               // File path
$result->metadata->durationSeconds;    // Duration in seconds
$result->metadata->effectiveSampleRate; // Sample rate in Hz
$result->metadata->channels;           // Number of channels
$result->metadata->frames;             // Total frames

$result->channelStats[0]->peakDb;      // Peak dB for channel 0
$result->channelStats[0]->averageDb;   // Average dB for channel 0

$result->execution->executionSeconds;  // Processing time
$result->execution->binaryVersion;     // goqm version
$result->execution->speedIndex;        // Processing speed index

// Convenience getter methods also available
$result->getLeqM();
$result->getDuration();
$result->getChannelPeakDb(0);

// Serialization
$result->toArray();              // Full result as array
$result->toJson();               // Full result as JSON string
```

### Custom Binary Path

```php
$leqm = new LeqmPhp('/custom/path/to/goqm');
$result = $leqm->measure('/path/to/audio.wav');
```

### Error Handling

```php
use Pforret\LeqmPhp\LeqmPhp;
use Pforret\LeqmPhp\Exceptions\BinaryNotFoundException;
use Pforret\LeqmPhp\Exceptions\MeasurementException;

try {
    $leqm = new LeqmPhp();
    $result = $leqm->measure('/path/to/audio.wav');
} catch (BinaryNotFoundException $e) {
    // Binary not found or not executable
    echo "Binary error: " . $e->getMessage();
} catch (MeasurementException $e) {
    // File not found or measurement failed
    echo "Measurement error: " . $e->getMessage();
}
```

## Supported Audio Formats

The goqm binary supports WAV files with various configurations:
- Sample rates: 44.1kHz, 48kHz, 96kHz, etc.
- Bit depths: 16-bit, 24-bit, 32-bit
- Channel layouts: Mono, Stereo, 5.1, 7.1

## API Reference

### LeqmPhp

| Method | Description |
|--------|-------------|
| `__construct(?string $binaryPath = null)` | Create instance with optional custom binary path |
| `measure(string $audioFile): LeqmResult` | Measure audio file and return results |
| `getBinaryPath(): string` | Get the path to the goqm binary |

### LeqmResult (DTO)

LeqmResult is a DTO with the following public properties:

| Property | Type | Description |
|----------|------|-------------|
| `metadata` | `Metadata` | File metadata |
| `measurements` | `Measurements` | Loudness measurements |
| `channelStats` | `array<ChannelStat>` | Per-channel statistics |
| `execution` | `Execution` | Execution info |
| `referenceOffsetDb` | `float` | Reference offset in dB |

### DTO Classes

#### Metadata
| Property | Type | Description |
|----------|------|-------------|
| `file` | `string` | Audio file path |
| `originalSampleRate` | `int` | Original sample rate in Hz |
| `effectiveSampleRate` | `int` | Effective sample rate in Hz |
| `channels` | `int` | Number of channels |
| `frames` | `int` | Total frames |
| `durationSeconds` | `float` | Duration in seconds |

#### Measurements
| Property | Type | Description |
|----------|------|-------------|
| `leqM` | `float` | Leq(M) weighted loudness in dB |
| `leqNoWeight` | `float` | Unweighted Leq in dB |
| `meanPower` | `float` | Mean power |
| `meanPowerWeighted` | `float` | Weighted mean power |

#### ChannelStat
| Property | Type | Description |
|----------|------|-------------|
| `channel` | `int` | Channel index |
| `peakDb` | `float` | Peak level in dB |
| `averageDb` | `float` | Average level in dB |

#### Execution
| Property | Type | Description |
|----------|------|-------------|
| `binaryPath` | `string` | Path to binary |
| `binaryVersion` | `string` | Binary version |
| `executionSeconds` | `float` | Processing time |
| `speedIndex` | `float` | Speed index |
| `mbps` | `float` | Megabytes per second |

### Exceptions

- `LeqmException` - Base exception class
- `BinaryNotFoundException` - Binary not found or not executable
- `MeasurementException` - File not found or measurement failed

## Testing

```bash
composer test
```

## Code Style

```bash
composer lint
```

## About LEQ(m)

LEQ(m) (Equivalent Continuous Sound Level with M-weighting) is a loudness measurement standard used in cinema and broadcast. It provides a single number representing the average loudness of audio content, weighted to match human hearing perception.

The goqm binary is a Go implementation of the LEQ(m) algorithm, providing JSON output with detailed measurements and channel statistics.

## License

MIT

## Credits

- goqm binary from [pforret/leqm-nrt](https://github.com/pforret/leqm-nrt)
- Original leqm-nrt C code by Luca Trisciani
