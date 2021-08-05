<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation\Tests;

use PHPUnit\Framework\TestCase;
use Ropi\CardinalityEstimation\Factory\HyperLogLogCardinalityEstimatorFactory;
use Ropi\CardinalityEstimation\HyperLogLogCardinalityEstimator;

class HyperLogLogCardinalityEstimatorFactoryTest extends TestCase
{

    public function testCreate()
    {
        $factory = new HyperLogLogCardinalityEstimatorFactory();

        /** @var HyperLogLogCardinalityEstimator $estimator */
        $estimator = $factory->create();

        $this->assertInstanceOf(HyperLogLogCardinalityEstimator::class, $estimator);
    }

    public function testCreateWithConstructorArguments()
    {
        $factory = new HyperLogLogCardinalityEstimatorFactory(4, 'md5');

        /** @var HyperLogLogCardinalityEstimator $estimator */
        $estimator = $factory->create();

        $this->assertInstanceOf(HyperLogLogCardinalityEstimator::class, $estimator);
        $this->assertEquals($factory->getHashAlgorithm(), $estimator->getHashAlgorithm());
        $this->assertEquals($factory->getAccuracy(), $estimator->getAccuracy());
    }
}
