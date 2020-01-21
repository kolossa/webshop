<?php


namespace App\Cart;


/**
 * Class CartFactory
 * @package App\Cart
 */
class CartFactory
{
    public function create()
    {

        return new Cart();
    }

}
