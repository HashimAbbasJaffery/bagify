<?php

namespace App\View\Components\blueprints;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class section extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $heading,
        public string $description
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blueprints.section');
    }
}
