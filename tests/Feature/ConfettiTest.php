<?php

use AlexSyvolap\FilamentConfetti\Confetti;

it('flashes default confetti configuration to the session', function () {
    Confetti::shoot();

    $sessionData = session()->get(Confetti::EVENT);

    expect($sessionData)
        ->toBeArray()
        ->toHaveCount(1)
        ->and($sessionData[0])
        ->toHaveKey('particleCount', 150)
        ->toHaveKey('spread', 70)
        ->toHaveKey('shapes', ['square', 'circle']);
});

it('builds custom configuration using fluent methods', function () {
    Confetti::count(300)
        ->spread(120)
        ->shapes(['star'])
        ->startVelocity(45)
        ->shoot();

    $sessionData = session()->get(Confetti::EVENT);

    expect($sessionData[0])
        ->toHaveKey('particleCount', 300)
        ->toHaveKey('spread', 120)
        ->toHaveKey('shapes', ['star'])
        ->toHaveKey('startVelocity', 45);
});

it('sets correct origin for screen positions', function () {
    Confetti::topLeft()->shoot();

    $sessionData = session()->get(Confetti::EVENT);

    expect($sessionData[0]['origin'])
        ->toHaveKey('x', 0)
        ->toHaveKey('y', 0)
        ->and($sessionData[0]['angle'])
        ->toBe(315);
});

it('handles multi-shots correctly using then()', function () {
    Confetti::left()->count(100)->then()->right()->count(200)->shoot();

    $sessionData = session()->get(Confetti::EVENT);

    expect($sessionData)
        ->toBeArray()
        ->toHaveCount(2)
        ->and($sessionData[0])
        ->toHaveKey('particleCount', 100)
        ->toHaveKey('angle', 0)
        ->and($sessionData[1])
        ->toHaveKey('particleCount', 200)
        ->toHaveKey('angle', 180);
});

it('uses presets generator and clears options', function () {
    Confetti::emoji('🦄')->shoot();

    $sessionData = session()->get(Confetti::EVENT);

    expect($sessionData)
        ->toBeArray()
        ->toHaveCount(9)
        ->and($sessionData[0]['shapes'][0])
        ->toHaveKey('type', 'text')
        ->toHaveKey('text', '🦄');
});

it('supports complex cycles using make() method', function () {
    $confetti = Confetti::make();

    for ($delay = 0; $delay < 500; $delay += 100) {
        $confetti->center()->delay($delay)->then();
    }
    $confetti->shoot();

    $sessionData = session()->get(Confetti::EVENT);

    expect($sessionData)
        ->toBeArray()
        ->toHaveCount(5)
        ->and($sessionData[4]['delay'])
        ->toBe(400);
});
