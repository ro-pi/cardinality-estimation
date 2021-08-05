<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation\Factory;

use Ropi\CardinalityEstimation\CardinalityEstimatorInterface;

interface CardinalityEstimatorFactoryInterface
{
    function create(): CardinalityEstimatorInterface;
}
