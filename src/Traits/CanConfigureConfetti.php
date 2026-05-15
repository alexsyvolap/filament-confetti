<?php

namespace AlexSyvolap\FilamentConfetti\Traits;

trait CanConfigureConfetti
{
    public function count(int $count): static
    {
        $this->options['particleCount'] = $count;

        return $this;
    }

    public function spread(int $spread): static
    {
        $this->options['spread'] = $spread;

        return $this;
    }

    public function angle(int $angle): static
    {
        $this->options['angle'] = $angle;

        return $this;
    }

    public function startVelocity(float | int $velocity): static
    {
        $this->options['startVelocity'] = $velocity;

        return $this;
    }

    public function decay(float $decay): static
    {
        $this->options['decay'] = $decay;

        return $this;
    }

    public function colors(array $colors): static
    {
        $this->options['colors'] = $colors;

        return $this;
    }

    public function shapes(array $shapes): static
    {
        $this->options['shapes'] = $shapes;

        return $this;
    }

    public function scalar(float $scalar): static
    {
        $this->options['scalar'] = $scalar;

        return $this;
    }

    public function ticks(int $ticks): static
    {
        $this->options['ticks'] = $ticks;

        return $this;
    }

    public function gravity(float $gravity): static
    {
        $this->options['gravity'] = $gravity;

        return $this;
    }

    public function drift(float $drift): static
    {
        $this->options['drift'] = $drift;

        return $this;
    }

    public function zIndex(int $zIndex): static
    {
        $this->options['zIndex'] = $zIndex;

        return $this;
    }

    public function flat(bool $flat = true): static
    {
        $this->options['flat'] = $flat;

        return $this;
    }

    public function disableForReducedMotion(bool $disable = true): static
    {
        $this->options['disableForReducedMotion'] = $disable;

        return $this;
    }

    public function origin(float $x, float $y): static
    {
        $this->options['origin'] = ['x' => $x, 'y' => $y];

        return $this;
    }

    public function delay(int $milliseconds): static
    {
        $this->options['delay'] = $milliseconds;

        return $this;
    }

    public function shapeFromPath(string $path, array $matrix = []): static
    {
        $this->options['shapes'][] = [
            'type' => 'path',
            'path' => $path,
            'matrix' => empty($matrix) ? null : $matrix,
        ];

        return $this;
    }

    public function shapeFromText(string $text, float | int $scalar = 2): static
    {
        $this->options['shapes'][] = [
            'type' => 'text',
            'text' => $text,
            'scalar' => $scalar,
        ];

        return $this;
    }
}
