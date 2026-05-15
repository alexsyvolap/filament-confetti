@php
    use AlexSyvolap\FilamentConfetti\Confetti;
@endphp

<div x-data="filamentConfetti({
    sessionData: @js(session()->get(Confetti::EVENT)),
    eventName: '{{ Confetti::EVENT }}'
})"></div>
