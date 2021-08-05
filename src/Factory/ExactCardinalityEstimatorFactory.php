<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation\Factory;

use Ropi\CardinalityEstimation\CardinalityEstimatorInterface;
use Ropi\CardinalityEstimation\ExactCardinalityEstimator;

class ExactCardinalityEstimatorFactory implements CardinalityEstimatorFactoryInterface
{
    public function __construct() {}

    public function create(): CardinalityEstimatorInterface
    {
        return new ExactCardinalityEstimator();
    }
}
