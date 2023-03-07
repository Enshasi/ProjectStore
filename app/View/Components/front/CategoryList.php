<?php

namespace App\View\Components\front;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryList extends Component
{
    public $categories;
    public $products;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = Category::with('product','child')->limit(10)->get();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // return view('components.front.category-list');
    }
}
