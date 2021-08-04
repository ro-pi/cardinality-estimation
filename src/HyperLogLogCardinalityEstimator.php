<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation;

class HyperLogLogCardinalityEstimator implements CardinalityEstimatorInterface
{
    protected \SplFixedArray $registers;
    protected float $alpha;
    protected string $hashAlgorithm;
    protected int $hashSize;
    protected int $accuracy;
    protected int $accuracyComplement;
    protected int $valueBitMask;

    // TODO: Change to murmurhash3  if php 8.1 is available
    public function __construct(int $accuracy = 14, string $hashAlgorithm = 'fnv1a64')
    {
        if ($accuracy < 4 || $accuracy > 16) {
            throw new \InvalidArgumentException('Argument $accuracy must be a value between 4 and 16');
        }

        if (!in_array($hashAlgorithm, hash_algos())) {
            throw new \InvalidArgumentException(
                'Argument $hashAlgorithm must be one of the following values: ' . implode(', ', hash_algos())
            );
        }

        $numRegisters = 2 ** $accuracy;

        if ($numRegisters === 16) {
            $this->alpha = 0.673;
        } elseif ($numRegisters === 32) {
            $this->alpha = 0.697;
        } elseif ($numRegisters === 64) {
            $this->alpha = 0.709;
        } else {
            $this->alpha = 0.7213 / (1 + 1.079 / $numRegisters);
        }

        $this->registers = new \SplFixedArray($numRegisters);
        $this->hashAlgorithm = $hashAlgorithm;

        $this->hashSize = strlen($this->hashString('0'));
        if ($this->hashSize < 32) {
            $this->hashSize = 32;
        }

        $this->accuracy = $accuracy;
        $this->accuracyComplement = $this->hashSize - $this->accuracy;
        $this->valueBitMask = (2 ** $this->accuracyComplement - 1);
    }

    public function addValue(string $value): void
    {
        $hash = $this->hash($value);

        $prefix = $hash >> $this->accuracyComplement;
        $value = $hash & $this->valueBitMask;
        $lsbPosition = 1 + $this->countTrailingZeros($value, $this->accuracyComplement);

        if ($lsbPosition > ($this->registers[$prefix] ?? 0)) {
            $this->registers[$prefix] = $lsbPosition;
        }
    }

    public function estimate(): int
    {
        $sum = 0.0;
        $numZeros = 0;

        for ($i = 0; $i < $this->registers->getSize(); $i++) {
            if ($this->registers[$i] == 0) {
                $sum += 1.0;
                $numZeros++;
            } else {
                $sum += (1.0 / (2 ** $this->registers[$i]));
            }
        }

        $estimate = (1.0 / $sum) * $this->alpha * $this->registers->getSize() * $this->registers->getSize();
        if ($numZeros && $estimate < ($this->registers->getSize() * 2.5)) {
            // Linear Counting
            $estimate = log($this->registers->getSize() / $numZeros) * $this->registers->getSize();
        }

        return (int) $estimate;
    }

    protected function countTrailingZeros(int $value, int $width): int
    {
        if ($value == 0) {
            return $width;
        }

        $count = 0;

        while (($value & 1) == 0)
        {
            $value = $value >> 1;
            $count++;
        }

        return $count;
    }

    protected function hash(string $data): int
    {
        return crc32($this->hashString($data));
    }

    protected function hashString(string $data): string
    {
        $hashString = hash($this->getHashAlgorithm(), $data);
        if (!is_string($hashString)) {
            throw new \RuntimeException(
                'Failed to calculate hash with algorithm "'
                . $this->getHashAlgorithm()
                . '".',
                1618833849
            );
        }

        return $hashString;
    }

    public function getAccuracy(): int
    {
        return $this->accuracy;
    }

    public function getHashAlgorithm(): string
    {
        return $this->hashAlgorithm;
    }
}
