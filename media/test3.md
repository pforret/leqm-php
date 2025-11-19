# test3.wav

## Summary

| Property | Value |
|----------|-------|
| Duration | 5.0 seconds |
| Sample Rate | 48000 Hz |
| Channels | 8 (7.1 surround) |
| Bit Depth | 24-bit |
| Codec | PCM signed 24-bit little-endian |
| File Size | 5,761,082 bytes |
| Bit Rate | 9,216 kbps |

## Loudness Measurements

| Metric | Value |
|--------|-------|
| Leq(M) | 82.83 dB |
| Leq (no weight) | 95.23 dB |
| Mean Power | 0.0527 |
| Mean Power (weighted) | 0.003 |

## Channel Statistics

| Channel | Peak (dB) | Average (dB) |
|---------|-----------|--------------|
| 0 (FL) | 105.83 | 88.54 |
| 1 (FR) | 105.28 | 88.59 |
| 2 (FC) | 101.52 | 83.33 |
| 3 (LFE) | 104.02 | 90.77 |
| 4 (BL) | 97.70 | 83.91 |
| 5 (BR) | 97.63 | 83.87 |
| 6 (SL) | 0.00 | 0.00 |
| 7 (SR) | 0.00 | 0.00 |

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
            "channels": 8,
            "channel_layout": "7.1",
            "bits_per_sample": 24,
            "duration": "5.000833",
            "bit_rate": "9216000"
        }
    ],
    "format": {
        "format_name": "wav",
        "duration": "5.000833",
        "size": "5761082",
        "bit_rate": "9216195",
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
    "file": "test3.wav",
    "original_sample_rate": 48000,
    "effective_sample_rate": 48000,
    "channels": 8,
    "frames": 240040,
    "duration_seconds": 5.0
  },
  "measurements": {
    "leq_m": 82.83,
    "leq_no_weight": 95.23,
    "mean_power": 0.0527,
    "mean_power_weighted": 0.003
  },
  "reference_offset_db": 108.010299957,
  "channel_stats": [
    {"channel": 0, "peak_db": 105.8265, "average_db": 88.5406},
    {"channel": 1, "peak_db": 105.2786, "average_db": 88.5868},
    {"channel": 2, "peak_db": 101.5212, "average_db": 83.329},
    {"channel": 3, "peak_db": 104.0188, "average_db": 90.7712},
    {"channel": 4, "peak_db": 97.7041, "average_db": 83.9051},
    {"channel": 5, "peak_db": 97.6334, "average_db": 83.868},
    {"channel": 6, "peak_db": 0.0, "average_db": 0.0},
    {"channel": 7, "peak_db": 0.0, "average_db": 0.0}
  ],
  "execution": {
    "binary_version": "0.4.0"
  }
}
```
