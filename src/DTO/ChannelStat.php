<?php

namespace Pforret\LeqmPhp\DTO;

class ChannelStat
{
    public function __construct(
        public int $channel,
        public float $peakDb,
        public float $averageDb,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            channel: $data['channel'] ?? 0,
            peakDb: $data['peak_db'] ?? 0.0,
            averageDb: $data['average_db'] ?? 0.0,
        );
    }

    public function toArray(): array
    {
        return [
            'channel' => $this->channel,
            'peak_db' => $this->peakDb,
            'average_db' => $this->averageDb,
        ];
    }
}
