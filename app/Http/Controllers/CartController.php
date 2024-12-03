<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    protected $sessionKey = 'cart';

    // public function add($product)
    // {
    //     $cart = Session::get($this->sessionKey, []);
    //     $cart[] = $product;
    //     Session::put($this->sessionKey, $cart);
    // }

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->get();

        return inertia('Cart/Index', [
            'cart' => $cart,
        ]);
    }

    public function add(Request $request)
    {

        $product = $request->all(); // Asegúrate de validar y sanitizar los datos del producto
        $cart = Session::get($this->sessionKey, []);
        $cart[] = $product;
        Session::put($this->sessionKey, $cart);
        // $this->cartService->add($product);

    }

    public function remove(Request $request, $productId)
    {
        $this->cartService->remove($productId);

        return response()->json(['message' => 'Producto eliminado del carrito']);
    }

    public function clear()
    {
        $this->cartService->clear();

        // return response()->json(['message' => 'Carrito vaciado']);
    }

    public function get()
    {
        $cart = $this->cartService->get();

        return response()->json($cart);
    }
}
