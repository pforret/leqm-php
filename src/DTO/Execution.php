<?php

namespace Pforret\LeqmPhp\DTO;

readonly class Execution
{
    public function __construct(
        public string $binaryPath,
        public string $binaryVersion,
        public float $executionSeconds,
        public float $speedIndex,
        public float $mbps,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            binaryPath: $data['binary_path'] ?? '',
            binaryVersion: $data['binary_version'] ?? '',
            executionSeconds: $data['execution_seconds'] ?? 0.0,
            speedIndex: $data['speed_index'] ?? 0.0,
            mbps: $data['mbps'] ?? 0.0,
        );
    }

    public function toArray(): array
    {
        return [
            'binary_path' => $this->binaryPath,
            'binary_version' => $this->binaryVersion,
            'execution_seconds' => $this->executionSeconds,
            'speed_index' => $this->speedIndex,
            'mbps' => $this->mbps,
        ];
    }
}
