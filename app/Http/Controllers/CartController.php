<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\interfaces\addToCartInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
   protected addToCartInterface $addToCartInterface;
   public function __construct(addToCartInterface $addToCartInterface)
   {
       $this->addToCartInterface=$addToCartInterface;
   }
   public function insert( Request $req){
       return $this->addToCartInterface->insertCart($req);
   }
   public function updateCart(Request $req, $id){
       return $this->addToCartInterface->updateCartGame($req,$id);
   }
   public function checkInCart($gid,$uid){
       return $this->addToCartInterface->checkInCartCount($gid,$uid);
   }
   public function getCartlistCount($uid){
       return $this->addToCartInterface->getCartListCount($uid);
   }
   public function deleteCartGame($id){
       return $this->addToCartInterface->deletingCartGame($id);
   }
}
