<?php

namespace AlexSyvolap\FilamentConfetti\Tests;

use AlexSyvolap\FilamentConfetti\FilamentConfettiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            FilamentConfettiServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('session.driver', 'array');
    }
}
