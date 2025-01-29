<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductsComponent extends Component
{
    public $product;
    public $imagePath;
    public $deleteRoute;

    /**
     * Create a new component instance.
     */
    public function __construct($product, $imagePath, $deleteRoute)
    {
        $this->product = $product;
        $this->imagePath = $imagePath;
        $this->deleteRoute = $deleteRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.products-component');
    }
}
