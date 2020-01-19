<?php

namespace App\Http\Controllers;

use App\Cart\CartService;
use Illuminate\Http\Request;

class EmptyCartController extends Controller
{
    /**
     * @var CartService $cartService
     */
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function __invoke(Request $request)
    {
        $this->cartService->empty($request->session()->getId());
        return ['msg' => 'Your cart is empty!'];
    }
}
