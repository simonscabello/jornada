<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public bool $checked = false,
        public ?string $value = null
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
