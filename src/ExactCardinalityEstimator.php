<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation;

class ExactCardinalityEstimator implements CardinalityEstimatorInterface
{
    protected array $values = [];

    public function addValue(string $value): void
    {
        $this->values[$value] = $value;
    }

    public function estimate(): int
    {
        return count($this->values);
    }
}
