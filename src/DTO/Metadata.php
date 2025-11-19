<?php

namespace Pforret\LeqmPhp\DTO;

readonly class Metadata
{
    public function __construct(
        public string $file,
        public int $originalSampleRate,
        public int $effectiveSampleRate,
        public int $channels,
        public int $frames,
        public float $durationSeconds,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            file: $data['file'] ?? '',
            originalSampleRate: $data['original_sample_rate'] ?? 0,
            effectiveSampleRate: $data['effective_sample_rate'] ?? 0,
            channels: $data['channels'] ?? 0,
            frames: $data['frames'] ?? 0,
            durationSeconds: $data['duration_seconds'] ?? 0.0,
        );
    }

    public function toArray(): array
    {
        return [
            'file' => $this->file,
            'original_sample_rate' => $this->originalSampleRate,
            'effective_sample_rate' => $this->effectiveSampleRate,
            'channels' => $this->channels,
            'frames' => $this->frames,
            'duration_seconds' => $this->durationSeconds,
        ];
    }
}
