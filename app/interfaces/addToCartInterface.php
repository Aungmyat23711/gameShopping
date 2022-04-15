<?php
namespace App\interfaces;

interface addToCartInterface{
    public function insertCart($cart);
    public function updateCartGame($cart,$id);
    public function checkInCartCount($gid,$uid);
    public function getCartListCount($uid);
    public function deletingCartGame($id);
}