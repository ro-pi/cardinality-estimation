<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation\Factory;

use Ropi\CardinalityEstimation\CardinalityEstimatorInterface;
use Ropi\CardinalityEstimation\HyperLogLogCardinalityEstimator;

class HyperLogLogCardinalityEstimatorFactory implements CardinalityEstimatorFactoryInterface
{
    public function __construct(
        private ?int $accuracy = null,
        private ?string $hashAlgorithm = null
    ) {}

    public function create(): CardinalityEstimatorInterface
    {
        $arguments = [];

        $accuracy = $this->getAccuracy();
        $hashAlgorithm = $this->getHashAlgorithm();

        if ($accuracy !== null) {
            $arguments['accuracy'] = $accuracy;
        }

        if ($hashAlgorithm !== null) {
            $arguments['hashAlgorithm'] = $hashAlgorithm;
        }

        return new HyperLogLogCardinalityEstimator(...$arguments);
    }

    public function getHashAlgorithm(): ?string
    {
        return $this->hashAlgorithm;
    }

    public function getAccuracy(): ?int
    {
        return $this->accuracy;
    }
}
