<?php

namespace Pforret\LeqmPhp;

use Pforret\LeqmPhp\DTO\ChannelStat;
use Pforret\LeqmPhp\DTO\Execution;
use Pforret\LeqmPhp\DTO\Measurements;
use Pforret\LeqmPhp\DTO\Metadata;

readonly class LeqmResult
{
    public Metadata $metadata;

    public Measurements $measurements;

    /** @var array<ChannelStat> */
    public array $channelStats;

    public Execution $execution;

    public float $referenceOffsetDb;

    public function __construct(array $data)
    {
        $this->metadata = Metadata::fromArray($data['metadata'] ?? []);
        $this->measurements = Measurements::fromArray($data['measurements'] ?? []);
        $this->channelStats = array_map(
            fn (array $stat) => ChannelStat::fromArray($stat),
            $data['channel_stats'] ?? []
        );
        $this->execution = Execution::fromArray($data['execution'] ?? []);
        $this->referenceOffsetDb = $data['reference_offset_db'] ?? 0.0;
    }

    // Convenience accessors for backward compatibility

    // Metadata
    public function getFile(): string
    {
        return $this->metadata->file;
    }

    public function getSampleRate(): int
    {
        return $this->metadata->effectiveSampleRate;
    }

    public function getOriginalSampleRate(): int
    {
        return $this->metadata->originalSampleRate;
    }

    public function getChannels(): int
    {
        return $this->metadata->channels;
    }

    public function getFrames(): int
    {
        return $this->metadata->frames;
    }

    public function getDuration(): float
    {
        return $this->metadata->durationSeconds;
    }

    // Measurements
    public function getLeqM(): float
    {
        return $this->measurements->leqM;
    }

    public function getLeqNoWeight(): float
    {
        return $this->measurements->leqNoWeight;
    }

    public function getMeanPower(): float
    {
        return $this->measurements->meanPower;
    }

    public function getMeanPowerWeighted(): float
    {
        return $this->measurements->meanPowerWeighted;
    }

    // Channel stats
    /** @return array<ChannelStat> */
    public function getChannelStats(): array
    {
        return $this->channelStats;
    }

    public function getChannelPeakDb(int $channel): float
    {
        return $this->channelStats[$channel]->peakDb ?? 0.0;
    }

    public function getChannelAverageDb(int $channel): float
    {
        return $this->channelStats[$channel]->averageDb ?? 0.0;
    }

    // Execution
    public function getExecutionTime(): float
    {
        return $this->execution->executionSeconds;
    }

    public function getBinaryVersion(): string
    {
        return $this->execution->binaryVersion;
    }

    public function getSpeedIndex(): float
    {
        return $this->execution->speedIndex;
    }

    // Serialization
    public function toArray(): array
    {
        return [
            'metadata' => $this->metadata->toArray(),
            'measurements' => $this->measurements->toArray(),
            'reference_offset_db' => $this->referenceOffsetDb,
            'channel_stats' => array_map(
                fn (ChannelStat $stat) => $stat->toArray(),
                $this->channelStats
            ),
            'execution' => $this->execution->toArray(),
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}
