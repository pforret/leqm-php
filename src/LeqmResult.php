<?php

namespace Pforret\LeqmPhp;

class LeqmResult
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // Metadata accessors
    public function getFile(): string
    {
        return $this->data['metadata']['file'] ?? '';
    }

    public function getSampleRate(): int
    {
        return $this->data['metadata']['effective_sample_rate'] ?? 0;
    }

    public function getOriginalSampleRate(): int
    {
        return $this->data['metadata']['original_sample_rate'] ?? 0;
    }

    public function getChannels(): int
    {
        return $this->data['metadata']['channels'] ?? 0;
    }

    public function getFrames(): int
    {
        return $this->data['metadata']['frames'] ?? 0;
    }

    public function getDuration(): float
    {
        return $this->data['metadata']['duration_seconds'] ?? 0.0;
    }

    // Main measurement accessors
    public function getLeqM(): float
    {
        return $this->data['measurements']['leq_m'] ?? 0.0;
    }

    public function getLeqNoWeight(): float
    {
        return $this->data['measurements']['leq_no_weight'] ?? 0.0;
    }

    public function getMeanPower(): float
    {
        return $this->data['measurements']['mean_power'] ?? 0.0;
    }

    public function getMeanPowerWeighted(): float
    {
        return $this->data['measurements']['mean_power_weighted'] ?? 0.0;
    }

    // Channel stats
    public function getChannelStats(): array
    {
        return $this->data['channel_stats'] ?? [];
    }

    public function getChannelPeakDb(int $channel): float
    {
        return $this->data['channel_stats'][$channel]['peak_db'] ?? 0.0;
    }

    public function getChannelAverageDb(int $channel): float
    {
        return $this->data['channel_stats'][$channel]['average_db'] ?? 0.0;
    }

    // Execution info
    public function getExecutionTime(): float
    {
        return $this->data['execution']['execution_seconds'] ?? 0.0;
    }

    public function getBinaryVersion(): string
    {
        return $this->data['execution']['binary_version'] ?? '';
    }

    public function getSpeedIndex(): float
    {
        return $this->data['execution']['speed_index'] ?? 0.0;
    }

    // Raw data access
    public function toArray(): array
    {
        return $this->data;
    }

    public function toJson(): string
    {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}
