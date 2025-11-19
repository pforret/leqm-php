# test4.wav

## Summary

| Property | Value |
|----------|-------|
| Duration | 5.0 seconds |
| Sample Rate | 48000 Hz |
| Channels | 6 (5.1 surround) |
| Bit Depth | 24-bit |
| Codec | PCM signed 24-bit little-endian |
| File Size | 4,320,122 bytes |
| Bit Rate | 6,912 kbps |

## Loudness Measurements

| Metric | Value |
|--------|-------|
| Leq(M) | 83.16 dB |
| Leq (no weight) | 92.58 dB |
| Mean Power | 0.0287 |
| Mean Power (weighted) | 0.0033 |

## Channel Statistics

| Channel | Peak (dB) | Average (dB) |
|---------|-----------|--------------|
| 0 (FL) | 97.45 | 83.87 |
| 1 (FR) | 103.40 | 89.96 |
| 2 (FC) | 95.78 | 82.74 |
| 3 (LFE) | 94.79 | 80.17 |
| 4 (BL) | 96.08 | 82.32 |
| 5 (BR) | 94.69 | 80.63 |

## FFprobe Output

```json
{
    "streams": [
        {
            "index": 0,
            "codec_name": "pcm_s24le",
            "codec_long_name": "PCM signed 24-bit little-endian",
            "codec_type": "audio",
            "sample_fmt": "s32",
            "sample_rate": "48000",
            "channels": 6,
            "channel_layout": "5.1",
            "bits_per_sample": 24,
            "duration": "5.000000",
            "bit_rate": "6912000"
        }
    ],
    "format": {
        "format_name": "wav",
        "duration": "5.000000",
        "size": "4320122",
        "bit_rate": "6912195",
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
    "file": "test4.wav",
    "original_sample_rate": 48000,
    "effective_sample_rate": 48000,
    "channels": 6,
    "frames": 240000,
    "duration_seconds": 5.0
  },
  "measurements": {
    "leq_m": 83.16,
    "leq_no_weight": 92.58,
    "mean_power": 0.0287,
    "mean_power_weighted": 0.0033
  },
  "reference_offset_db": 108.010299957,
  "channel_stats": [
    {"channel": 0, "peak_db": 97.4534, "average_db": 83.8683},
    {"channel": 1, "peak_db": 103.398, "average_db": 89.9602},
    {"channel": 2, "peak_db": 95.783, "average_db": 82.7366},
    {"channel": 3, "peak_db": 94.7923, "average_db": 80.1712},
    {"channel": 4, "peak_db": 96.0753, "average_db": 82.3151},
    {"channel": 5, "peak_db": 94.685, "average_db": 80.625}
  ],
  "execution": {
    "binary_version": "0.4.0"
  }
}
```
