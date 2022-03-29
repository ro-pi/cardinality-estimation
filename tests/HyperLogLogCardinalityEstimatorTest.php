<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation\Tests;

use PHPUnit\Framework\TestCase;
use Ropi\CardinalityEstimation\HyperLogLogCardinalityEstimator;

class HyperLogLogCardinalityEstimatorTest extends TestCase
{

    public function testEstimation56()
    {
        $estimator = new HyperLogLogCardinalityEstimator();

        for ($i = 0; $i < 56; $i++) {
            $estimator->addValue((string) $i);
            $estimator->addValue((string) $i);
        }

        $this->assertEquals(56, $estimator->estimate());
    }

    public function testEstimation555()
    {
        $estimator = new HyperLogLogCardinalityEstimator();

        for ($i = 0; $i < 555; $i++) {
            $estimator->addValue((string) $i);
            $estimator->addValue((string) $i);
        }

        $this->assertEquals(558, $estimator->estimate());
    }

    public function testEstimation100020()
    {
        $estimator = new HyperLogLogCardinalityEstimator();

        for ($i = 0; $i < 100020; $i++) {
            $estimator->addValue((string) $i);
            $estimator->addValue((string) $i);
        }

        $this->assertEquals(101118, $estimator->estimate());
    }

    public function testEstimation1000020()
    {
        $estimator = new HyperLogLogCardinalityEstimator();

        for ($i = 0; $i < 1000020; $i++) {
            $estimator->addValue((string) $i);
            $estimator->addValue((string) $i);
        }

        $this->assertEquals(995265, $estimator->estimate());
    }

    public function testEstimation10000532()
    {
        $estimator = new HyperLogLogCardinalityEstimator();

        for ($i = 0; $i < 10000532; $i++) {
            $estimator->addValue((string) $i);
        }

        $this->assertEquals(10037546, $estimator->estimate());
    }
}
