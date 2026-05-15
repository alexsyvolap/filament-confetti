<?php

namespace AlexSyvolap\FilamentConfetti;

/**
 * @method static ConfettiBuilder count(int $count)
 * @method static ConfettiBuilder spread(int $spread)
 * @method static ConfettiBuilder angle(int $angle)
 * @method static ConfettiBuilder startVelocity(float|int $velocity)
 * @method static ConfettiBuilder decay(float $decay)
 * @method static ConfettiBuilder colors(array $colors)
 * @method static ConfettiBuilder shapes(array $shapes)
 * @method static ConfettiBuilder scalar(float $scalar)
 * @method static ConfettiBuilder ticks(int $ticks)
 * @method static ConfettiBuilder gravity(float $gravity)
 * @method static ConfettiBuilder drift(float $drift)
 * @method static ConfettiBuilder zIndex(int $zIndex)
 * @method static ConfettiBuilder flat(bool $flat)
 * @method static ConfettiBuilder disableForReducedMotion(bool $disable)
 * @method static ConfettiBuilder origin(float $x, float $y)
 * @method static ConfettiBuilder center()
 * @method static ConfettiBuilder top()
 * @method static ConfettiBuilder bottom()
 * @method static ConfettiBuilder left()
 * @method static ConfettiBuilder right()
 * @method static ConfettiBuilder topLeft()
 * @method static ConfettiBuilder topRight()
 * @method static ConfettiBuilder bottomLeft()
 * @method static ConfettiBuilder bottomRight()
 * @method static ConfettiBuilder stars()
 * @method static ConfettiBuilder success()
 * @method static ConfettiBuilder magic()
 * @method static ConfettiBuilder rain()
 * @method static ConfettiBuilder schoolPride(int $duration = 15000)
 * @method static ConfettiBuilder snow(int $duration = 15000)
 * @method static ConfettiBuilder fireworks(int $duration = 15000)
 * @method static ConfettiBuilder realistic()
 * @method static ConfettiBuilder emoji(string $text = '🦄')
 * @method void shoot()
 */
class Confetti
{
    public const string EVENT = 'fire-confetti';

    public static function make(): ConfettiBuilder
    {
        return new ConfettiBuilder;
    }

    public static function __callStatic(string $name, array $arguments): ?ConfettiBuilder
    {
        return static::make()->$name(...$arguments);
    }
}
