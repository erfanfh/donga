<?php

namespace App\View\Components;

use App\Models\Meeting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class meeting_timeline extends Component
{
    public Meeting $meeting;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meeting_timeline');
    }
}
