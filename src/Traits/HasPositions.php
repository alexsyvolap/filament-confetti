<?php

namespace AlexSyvolap\FilamentConfetti\Traits;

trait HasPositions
{
    public function center(): static
    {
        return $this->origin(0.5, 0.5);
    }

    public function bottom(): static
    {
        return $this->origin(0.5, 1)->angle(90);
    }

    public function top(): static
    {
        return $this->origin(0.5, 0)->angle(270);
    }

    public function left(): static
    {
        return $this->origin(0, 0.5)->angle(0);
    }

    public function right(): static
    {
        return $this->origin(1, 0.5)->angle(180);
    }

    public function bottomLeft(): static
    {
        return $this->origin(0, 1)->angle(60);
    }

    public function bottomRight(): static
    {
        return $this->origin(1, 1)->angle(120);
    }

    public function topLeft(): static
    {
        return $this->origin(0, 0)->angle(315);
    }

    public function topRight(): static
    {
        return $this->origin(1, 0)->angle(225);
    }
}
