<?php

// app/Services/CartService.php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    protected $sessionKey = 'cart';

    public function add($product)
    {
        $cart = Session::get($this->sessionKey, []);
        $cart[] = $product;
        Session::put($this->sessionKey, $cart);
    }

    public function remove($productId)
    {
        $cart = Session::get($this->sessionKey, []);
        $cart = array_filter($cart, function ($item) use ($productId) {
            return $item['id'] !== $productId;
        });
        Session::put($this->sessionKey, $cart);
    }

    public function clear()
    {
        Session::forget($this->sessionKey);
    }

    public function get()
    {
        return Session::get($this->sessionKey, []);
    }
}
