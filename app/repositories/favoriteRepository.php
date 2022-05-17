<?php

namespace App\repositories;

use App\interfaces\favoriteInterface;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;

class favoriteRepository implements favoriteInterface
{
    public function createWhistlist($fav)
    {
        $data = new Favorite;
        $data->user_id = $fav->user_id;
        $data->game_id = $fav->game_id;
        $data->save();
    }
    public function getIsWhistListCount($id, $uid)
    {
        $data = Favorite::where('game_id', $id)->where('user_id', $uid)->count();
        return $data;
    }
    public function readWhishlist($uid)
    {
        $data = DB::table('games')
            ->join('favorites', 'games.id', 'favorites.game_id')
            ->select('games.*', 'favorites.id as fid', 'games.id as game_id')
            ->where('favorites.user_id', $uid)
            ->get();
        return $data;
    }
    public function deleteWhishlist($id)
    {
        $data = Favorite::find($id);
        $data->delete();
    }
    public function gotWhishlistCount($uid)
    {
        $data = Favorite::where('user_id', $uid)->count();
        return $data;
    }
}
