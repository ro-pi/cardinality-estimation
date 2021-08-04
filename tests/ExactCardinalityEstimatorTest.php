<?php
declare(strict_types=1);

namespace Ropi\CardinalityEstimation\Tests;

use PHPUnit\Framework\TestCase;
use Ropi\CardinalityEstimation\ExactCardinalityEstimator;

class ExactCardinalityEstimatorTest extends TestCase
{

    public function testEstimation56()
    {
        $estimator = new ExactCardinalityEstimator();

        for ($i = 0; $i < 56; $i++) {
            $estimator->addValue((string) $i);
            $estimator->addValue((string) $i);
        }

        $this->assertEquals(56, $estimator->estimate());
    }

    public function testEstimation555()
    {
        $estimator = new ExactCardinalityEstimator();

        for ($i = 0; $i < 555; $i++) {
            $estimator->addValue((string) $i);
            $estimator->addValue((string) $i);
        }

        $this->assertEquals(555, $estimator->estimate());
    }

    public function testEstimation100020()
    {
        $estimator = new ExactCardinalityEstimator();

        for ($i = 0; $i < 100020; $i++) {
            $estimator->addValue((string) $i);
            $estimator->addValue((string) $i);
        }

        $this->assertEquals(100020, $estimator->estimate());
    }

    public function testEstimation1000109()
    {
        $estimator = new ExactCardinalityEstimator();

        for ($i = 0; $i < 1000109; $i++) {
            $estimator->addValue((string) $i);
            $estimator->addValue((string) $i);
        }

        $this->assertEquals(1000109, $estimator->estimate());
    }
}
