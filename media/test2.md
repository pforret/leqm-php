# test2.wav

## Summary

| Property | Value |
|----------|-------|
| Duration | 5.0 seconds |
| Sample Rate | 48000 Hz |
| Channels | 2 (stereo) |
| Bit Depth | 16-bit |
| Codec | PCM signed 16-bit little-endian |
| File Size | 960,078 bytes |
| Bit Rate | 1,536 kbps |

## Loudness Measurements

| Metric | Value |
|--------|-------|
| Leq(M) | 74.75 dB |
| Leq (no weight) | 80.77 dB |
| Mean Power | 0.0019 |
| Mean Power (weighted) | 0.0005 |

## Channel Statistics

| Channel | Peak (dB) | Average (dB) |
|---------|-----------|--------------|
| 0 (L) | 92.55 | 77.01 |
| 1 (R) | 92.54 | 78.41 |

## FFprobe Output

```json
{
    "streams": [
        {
            "index": 0,
            "codec_name": "pcm_s16le",
            "codec_long_name": "PCM signed 16-bit little-endian",
            "codec_type": "audio",
            "sample_fmt": "s16",
            "sample_rate": "48000",
            "channels": 2,
            "bits_per_sample": 16,
            "duration": "5.000000",
            "bit_rate": "1536000"
        }
    ],
    "format": {
        "format_name": "wav",
        "duration": "5.000000",
        "size": "960078",
        "bit_rate": "1536124",
        "tags": {
            "encoder": "Lavf62.3.100"
        }
    }
}
```

## goqm Output

```json
{
  "metadata": {
    "file": "test2.wav",
    "original_sample_rate": 48000,
    "effective_sample_rate": 48000,
    "channels": 2,
    "frames": 240000,
    "duration_seconds": 5.0
  },
  "measurements": {
    "leq_m": 74.75,
    "leq_no_weight": 80.77,
    "mean_power": 0.0019,
    "mean_power_weighted": 0.0005
  },
  "reference_offset_db": 108.010299957,
  "channel_stats": [
    {
      "channel": 0,
      "peak_db": 92.5495,
      "average_db": 77.0074
    },
    {
      "channel": 1,
      "peak_db": 92.5369,
      "average_db": 78.4061
    }
  ],
  "execution": {
    "binary_version": "0.4.0"
  }
}
```
