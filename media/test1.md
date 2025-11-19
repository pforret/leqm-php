# test1.wav

## Summary

| Property | Value |
|----------|-------|
| Duration | 5.0 seconds |
| Sample Rate | 48000 Hz |
| Channels | 2 (stereo) |
| Bit Depth | 16-bit |
| Codec | PCM signed 16-bit little-endian |
| File Size | 960,098 bytes |
| Bit Rate | 1,536 kbps |

## Loudness Measurements

| Metric | Value |
|--------|-------|
| Leq(M) | 74.86 dB |
| Leq (no weight) | 81.96 dB |
| Mean Power | 0.0025 |
| Mean Power (weighted) | 0.0005 |

## Channel Statistics

| Channel | Peak (dB) | Average (dB) |
|---------|-----------|--------------|
| 0 (L) | 91.73 | 78.95 |
| 1 (R) | 91.73 | 78.95 |

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
        "size": "960098",
        "bit_rate": "1536156",
        "tags": {
            "encoder": "Lavf62.3.100",
            "timecode": "00:00:00:00"
        }
    }
}
```

## goqm Output

```json
{
  "metadata": {
    "file": "test1.wav",
    "original_sample_rate": 48000,
    "effective_sample_rate": 48000,
    "channels": 2,
    "frames": 240000,
    "duration_seconds": 5.0
  },
  "measurements": {
    "leq_m": 74.86,
    "leq_no_weight": 81.96,
    "mean_power": 0.0025,
    "mean_power_weighted": 0.0005
  },
  "reference_offset_db": 108.010299957,
  "channel_stats": [
    {
      "channel": 0,
      "peak_db": 91.7275,
      "average_db": 78.9516
    },
    {
      "channel": 1,
      "peak_db": 91.7275,
      "average_db": 78.9516
    }
  ],
  "execution": {
    "binary_version": "0.4.0"
  }
}
```
