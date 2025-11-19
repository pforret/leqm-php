<?php

namespace Pforret\LeqmPhp\DTO;

readonly class Measurements
{
    public function __construct(
        public float $leqM,
        public float $leqNoWeight,
        public float $meanPower,
        public float $meanPowerWeighted,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            leqM: $data['leq_m'] ?? 0.0,
            leqNoWeight: $data['leq_no_weight'] ?? 0.0,
            meanPower: $data['mean_power'] ?? 0.0,
            meanPowerWeighted: $data['mean_power_weighted'] ?? 0.0,
        );
    }

    public function toArray(): array
    {
        return [
            'leq_m' => $this->leqM,
            'leq_no_weight' => $this->leqNoWeight,
            'mean_power' => $this->meanPower,
            'mean_power_weighted' => $this->meanPowerWeighted,
        ];
    }
}
