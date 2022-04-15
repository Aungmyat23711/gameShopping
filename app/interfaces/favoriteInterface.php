<?php
namespace App\interfaces;
interface favoriteInterface{
    public function createWhistlist($fav);
    public function getIsWhistListCount($id,$uid);
    public function readWhishlist($uid);
    public function deleteWhishlist($id);
    public function gotWhishlistCount($uid);
}