# pforret/leqm-php

PHP library for LEQ(m) audio loudness measurement using the goqm binary.

## Requirements

- PHP 8.1+
- One of the supported platforms: macOS (Intel/ARM), Linux, or Windows

## Installation

```bash
composer require pforret/leqm-php
```

After installation, download the goqm binaries:

```bash
./vendor/pforret/leqm-php/bin/download-goqm.sh
```

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

```php
$result = $leqm->measure('/path/to/audio.wav');

// Main loudness values
$result->getLeqM();              // Leq(M) weighted loudness in dB
$result->getLeqNoWeight();       // Unweighted Leq in dB
$result->getMeanPower();         // Mean power
$result->getMeanPowerWeighted(); // Mean power (weighted)

// File metadata
$result->getFile();              // File path
$result->getDuration();          // Duration in seconds
$result->getSampleRate();        // Sample rate in Hz
$result->getChannels();          // Number of channels
$result->getFrames();            // Total frames

// Channel statistics
$result->getChannelStats();      // Array of all channel stats
$result->getChannelPeakDb(0);    // Peak dB for channel 0
$result->getChannelAverageDb(1); // Average dB for channel 1

// Execution info
$result->getExecutionTime();     // Processing time in seconds
$result->getBinaryVersion();     // goqm version
$result->getSpeedIndex();        // Processing speed index

// Raw data
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

### LeqmResult

| Method | Return Type | Description |
|--------|-------------|-------------|
| `getLeqM()` | `float` | Leq(M) weighted loudness in dB |
| `getLeqNoWeight()` | `float` | Unweighted Leq in dB |
| `getMeanPower()` | `float` | Mean power |
| `getMeanPowerWeighted()` | `float` | Weighted mean power |
| `getFile()` | `string` | Audio file path |
| `getDuration()` | `float` | Duration in seconds |
| `getSampleRate()` | `int` | Sample rate in Hz |
| `getOriginalSampleRate()` | `int` | Original sample rate |
| `getChannels()` | `int` | Number of channels |
| `getFrames()` | `int` | Total frames |
| `getChannelStats()` | `array` | All channel statistics |
| `getChannelPeakDb(int $channel)` | `float` | Peak dB for channel |
| `getChannelAverageDb(int $channel)` | `float` | Average dB for channel |
| `getExecutionTime()` | `float` | Processing time in seconds |
| `getBinaryVersion()` | `string` | goqm version |
| `getSpeedIndex()` | `float` | Processing speed index |
| `toArray()` | `array` | Full result as array |
| `toJson()` | `string` | Full result as JSON |

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
