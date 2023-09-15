# Cardinality estimation library for PHP

This library is a PHP based implementation for estimating [cardinalities](https://en.wikipedia.org/wiki/Cardinality).

Following cardinality estimators are implemented:
* [HyperLogLog](https://en.wikipedia.org/wiki/HyperLogLog) (approx. cardinality estimation but very low memory usage)
* Exact (exact cardinality estimation but very high memory usage)
  
### Requirements
* PHP ^8.1
## Installation
The library can be installed from a command line interface by using [composer](https://getcomposer.org/).

```
composer require ropi/cardinality-estimation
```

## Basic usage
```php
<?php
$estimator = new \Ropi\CardinalityEstimation\HyperLogLogCardinalityEstimator();

for ($i = 0; $i < 1000020; $i++) {
    $estimator->addValue((string) $i);
}

$estimator->estimate(); // Returns 995265 as approximated value
```
