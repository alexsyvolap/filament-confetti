<?php

namespace AlexSyvolap\FilamentConfetti\Traits;

trait HasPresets
{
    public function stars(): static
    {
        return $this->shapes(['star'])
            ->colors(['#FFD700', '#FFFFFF', '#FF8C00', '#FF4500'])
            ->scalar(1.2);
    }

    public function success(): static
    {
        return $this->colors(['#00FF00', '#32CD32', '#00EF10', '#ADFF2F', '#7CFC00']);
    }

    public function magic(): static
    {
        return $this->colors(['#a25afd', '#ff36ff', '#26ccff', '#ffffff'])
            ->shapes(['circle'])
            ->scalar(0.8);
    }

    public function rain(): static
    {
        return $this->top()->spread(180)->gravity(0.5)->drift(1)->ticks(500);
    }

    public function schoolPride(int $duration = 15000): static
    {
        $base = array_merge($this->getDefaults(), $this->options);
        $colors = $this->options['colors'] ?? ['#bb0000', '#ffffff'];

        for ($delay = 0; $delay < $duration; $delay += 30) {
            $this->shots[] = array_merge($base, [
                'particleCount' => 2, 'angle' => 60, 'spread' => 55,
                'origin' => ['x' => 0, 'y' => 0.5], 'colors' => $colors, 'delay' => $delay,
            ]);
            $this->shots[] = array_merge($base, [
                'particleCount' => 2, 'angle' => 120, 'spread' => 55,
                'origin' => ['x' => 1, 'y' => 0.5], 'colors' => $colors, 'delay' => $delay,
            ]);
        }

        $this->options = [];

        return $this;
    }

    public function snow(int $duration = 15000): static
    {
        $base = array_merge($this->getDefaults(), $this->options);
        $skew = 1.0;

        for ($delay = 0; $delay < $duration; $delay += 30) {
            $timeLeft = $duration - $delay;
            $ticks = max(200, (int) (500 * ($timeLeft / $duration)));
            $skew = max(0.8, $skew - 0.001);

            $this->shots[] = array_merge($base, [
                'particleCount' => 1, 'startVelocity' => 0, 'ticks' => $ticks,
                'origin' => ['x' => mt_rand(0, 100) / 100, 'y' => (mt_rand(0, 100) / 100 * $skew) - 0.2],
                'colors' => $this->options['colors'] ?? ['#ffffff'],
                'shapes' => ['circle'],
                'gravity' => mt_rand(40, 60) / 100,
                'scalar' => mt_rand(40, 100) / 100,
                'drift' => mt_rand(-40, 40) / 100,
                'delay' => $delay,
            ]);
        }

        $this->options = [];

        return $this;
    }

    public function fireworks(int $duration = 15000): static
    {
        $base = array_merge($this->getDefaults(), $this->options);
        $base = array_merge(['startVelocity' => 30, 'spread' => 360, 'ticks' => 60, 'zIndex' => 0], $base);

        for ($delay = 0; $delay < $duration; $delay += 250) {
            $timeLeft = $duration - $delay;
            $particleCount = (int) (50 * ($timeLeft / $duration));

            if ($particleCount > 0) {
                $this->shots[] = array_merge($base, [
                    'particleCount' => $particleCount,
                    'origin' => ['x' => mt_rand(10, 30) / 100, 'y' => mt_rand(0, 80) / 100 - 0.2],
                    'delay' => $delay,
                ]);
                $this->shots[] = array_merge($base, [
                    'particleCount' => $particleCount,
                    'origin' => ['x' => mt_rand(70, 90) / 100, 'y' => mt_rand(0, 80) / 100 - 0.2],
                    'delay' => $delay,
                ]);
            }
        }

        $this->options = [];

        return $this;
    }

    public function realistic(): static
    {
        $origin = $this->options['origin'] ?? ['x' => 0.5, 'y' => 0.5];
        $count = $this->options['particleCount'] ?? 200;
        $base = array_merge($this->getDefaults(), $this->options);

        $this->shots[] = array_merge($base, ['particleCount' => (int) ($count * 0.25), 'spread' => 26, 'startVelocity' => 55, 'origin' => $origin, 'delay' => 0]);
        $this->shots[] = array_merge($base, ['particleCount' => (int) ($count * 0.20), 'spread' => 60, 'origin' => $origin, 'delay' => 0]);
        $this->shots[] = array_merge($base, ['particleCount' => (int) ($count * 0.35), 'spread' => 100, 'decay' => 0.91, 'scalar' => 0.8, 'origin' => $origin, 'delay' => 0]);
        $this->shots[] = array_merge($base, ['particleCount' => (int) ($count * 0.10), 'spread' => 120, 'startVelocity' => 25, 'decay' => 0.92, 'scalar' => 1.2, 'origin' => $origin, 'delay' => 0]);
        $this->shots[] = array_merge($base, ['particleCount' => (int) ($count * 0.10), 'spread' => 120, 'startVelocity' => 45, 'origin' => $origin, 'delay' => 0]);

        $this->options = [];

        return $this;
    }

    public function emoji(string $text = '🦄'): static
    {
        $base = array_merge($this->getDefaults(), $this->options);

        $unicorn = ['type' => 'text', 'text' => $text, 'scalar' => $base['scalar'] ?? 2];
        $opts = array_merge($base, [
            'spread' => 360, 'ticks' => 60, 'gravity' => 0, 'decay' => 0.96, 'startVelocity' => 20,
            'shapes' => [$unicorn], 'scalar' => $base['scalar'] ?? 2,
        ]);

        for ($delay = 0; $delay <= 200; $delay += 100) {
            $this->shots[] = array_merge($opts, ['particleCount' => 30, 'delay' => $delay]);
            $this->shots[] = array_merge($opts, ['particleCount' => 5, 'flat' => true, 'delay' => $delay]);
            $this->shots[] = array_merge($opts, ['particleCount' => 15, 'scalar' => ($opts['scalar'] / 2), 'shapes' => ['circle'], 'delay' => $delay]);
        }

        $this->options = [];

        return $this;
    }
}
