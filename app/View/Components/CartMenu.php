<?php

namespace App\View\Components;

use App\Facades\Cart;
use App\Repositories\Cart\CartRepository;
use Illuminate\View\Component;

class CartMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $items;
    public $total;
    //Using Facades
    // public function __construct()
    // {
    //     $this->items = Cart::get();
    //     $this->total = Cart::total();
    // }
    //live Service container
    public function __construct(CartRepository $cart)
    {
        $this->items = $cart->get();
        $this->total = $cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
