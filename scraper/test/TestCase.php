<?php

namespace VertiKnow\Scraper;

include 'Mockery/Loader.php';
//include 'Hamcrest.php';

include __DIR__ . '/../logic/source/autoload.php';
include __DIR__ . '/../logic/vendor/autoload.php';

$loader = new \Mockery\Loader;
$loader->register();

class TestCase extends \PHPUnit\Framework\TestCase
{
    // trait to integrate Mockery, including self removal
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function tearDown() {
        \Mockery::close();
    }
}
