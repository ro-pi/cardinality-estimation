<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation\Tests;

use PHPUnit\Framework\TestCase;
use Ropi\CardinalityEstimation\ExactCardinalityEstimator;
use Ropi\CardinalityEstimation\Factory\ExactCardinalityEstimatorFactory;
use Ropi\CardinalityEstimation\HyperLogLogCardinalityEstimator;

class ExactCardinalityEstimatorFactoryTest extends TestCase
{

    public function testCreate()
    {
        $factory = new ExactCardinalityEstimatorFactory();

        /** @var HyperLogLogCardinalityEstimator $estimator */
        $estimator = $factory->create();

        $this->assertInstanceOf(ExactCardinalityEstimator::class, $estimator);
    }
}
