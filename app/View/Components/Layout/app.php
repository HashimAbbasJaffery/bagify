<?php

namespace App\View\Components\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class app extends Component
{
    /**
     * Create a new component instance.
     */
    public $header;
    public function __construct(
        $header = 'layout.parts.header'
    )
    {
        $this->header = $header;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd($this->header);
        return view('components.layout.app');
    }
}
