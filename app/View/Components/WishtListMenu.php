<?php

namespace App\View\Components;

use App\Models\wishlist;
use Illuminate\View\Component;

class WishtListMenu extends Component
{
    public $items;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->items = wishlist::get() ;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wisht-list-menu');
    }
}
