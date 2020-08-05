<?php

namespace App\View\Components\Layouts;

use App\Models\Navigation;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $navigations = Navigation::with('children')->where('parent_id',0)->orderBy('order', 'asc')->get();
        return view('components.layouts.sidebar',compact('navigations'));
    }
}
