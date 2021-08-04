<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation;

interface CardinalityEstimatorInterface
{
    function addValue(string $value): void;
    function estimate(): int;
}
