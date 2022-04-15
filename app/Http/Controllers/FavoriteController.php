<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\interfaces\favoriteInterface;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
  protected favoriteInterface $favoriteInterface;
  public function __construct(favoriteInterface $favoriteInterface)
  {
     $this->favoriteInterface=$favoriteInterface;   
  }
  public function create(Request $req)
  {
      return $this->favoriteInterface->createWhistlist($req);
  }
  public function getIsWhistList($id,$uid)
  {
      return $this->favoriteInterface->getIsWhistListCount($id,$uid);
  }
  public function read($uid){
    return $this->favoriteInterface->readWhishlist($uid);
  }
  public function delete($id){
    return $this->favoriteInterface->deleteWhishlist($id);
  }
  public function getWhishlistCount($uid){
    return $this->favoriteInterface->gotWhishlistCount($uid);
  }
}
