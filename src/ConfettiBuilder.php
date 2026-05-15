<?php

namespace AlexSyvolap\FilamentConfetti;

use Livewire\Livewire;

class ConfettiBuilder
{
    use Traits\CanConfigureConfetti;
    use Traits\HasPositions;
    use Traits\HasPresets;

    protected array $options = [];

    protected array $shots = [];

    public function then(): static
    {
        $this->shots[] = array_merge($this->getDefaults(), $this->options);
        $this->options = [];

        return $this;
    }

    public function shoot(): void
    {
        if (! empty($this->options) || empty($this->shots)) {
            $this->shots[] = array_merge($this->getDefaults(), $this->options);
        }

        if (class_exists('\Livewire\Livewire') && Livewire::isLivewireRequest()) {
            $component = app('livewire')->current();

            if ($component) {
                $component->dispatch(Confetti::EVENT, $this->shots);
                $this->reset();

                return;
            }
        }

        session()->flash(Confetti::EVENT, array_merge(
            session()->get(Confetti::EVENT, []),
            $this->shots
        ));

        $this->reset();
    }

    protected function reset(): void
    {
        $this->shots = [];
        $this->options = [];
    }

    protected function getDefaults(): array
    {
        return [
            'particleCount' => 150,
            'spread' => 70,
            'colors' => ['#26ccff', '#a25afd', '#ff5e7e', '#88ff5a', '#fcff42', '#ffa62d', '#ff36ff'],
            'shapes' => ['square', 'circle'],
            'ticks' => 200,
        ];
    }
}
