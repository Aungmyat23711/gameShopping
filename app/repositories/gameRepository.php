<?php

namespace App\repositories;

use App\interfaces\gameInterface;
use App\Models\Game;
use App\Models\Platform;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class gameRepository implements gameInterface{
    public function add($game)
    {
        if($game->image){
            $file=$game->image;
        $ext=$file->getClientOriginalExtension();
        $photo=time().'.'.$ext;
        $path=$file->move('resources/',$photo);
        }else{
            $photo=null;
        }
        if($game->image_item){
            $file=$game->image_item;
        $ext=$file->getClientOriginalExtension();
        $photo2=time().'.'.$ext;
        $path=$file->move('resources/',$photo2);
        }else{
            $photo2=null;
        }
        $data=new Game();
        $data->name=$game->name;
        $data->release_date=$game->release_date;
        $data->publisher=$game->publisher;
        $data->developer=$game->developer;
        $data->rated=$game->rated;
        $data->game_mode=$game->game_mode;
        $data->price=$game->price;
        $data->qty=$game->qty;
        $data->discount=$game->discount;
        $data->platform=$game->platform;
        $data->image=$photo;
        $data->image_item=$photo2;
        $data->description=$game->description;
        $data->save();
    }
    public function get()
    {
        $data=Game::all();
        return $data;
    }
    public function put($id,$game)
    {
        
        global $photo;
        global $photo2;
        if($game->image==null){
            $photo=$game->current;
        }else{
            $file=$game->image;
            $ext=$file->getClientOriginalExtension();
            $photo= time().'.'.$ext;
            $path=$file->move('resources/',$photo);
        }
        if($game->image_item==null){
            $photo2=$game->current_item;
        }else{
            $file2=$game->image_item;
            $ext2=$file2->getClientOriginalExtension();
            $photo2= time().'.'.$ext2;
            $path=$file2->move('resources/',$photo2);
        }
        $data=Game::find($id);
        $data->name=$game->name;
        $data->release_date=$game->release_date;
        $data->publisher=$game->publisher;
        $data->developer=$game->developer;
        $data->rated=$game->rated;
        $data->game_mode=$game->game_mode;
        $data->price=$game->price;
        $data->qty=$game->qty;
        $data->discount=$game->discount;
        $data->platform=$game->platform;
        $data->image=$photo;
        $data->image_item=$photo2;
        $data->description=$game->description;
        $data->save();
    }
    public function getById($id)
    {
        $data=Game::where('id',$id)->get();
        return $data;
        // $data=DB::table('games')
        // ->join('totalplatforms','games.id','totalplatforms.game_id')
        // ->where('games.id',$id)
        // ->select('*')->get();
        // return $data;
    }
    public function delete($id)
    {
        if(File::exists("resources/$id"))
        {
            File::deleteDirectory("resources/$id");
        }
        $data=Game::find($id);
        $data->delete();
    }
    public function getGamesCategory()
    {
        $data=DB::table('games')
        ->join('totalcategories','games.id','totalcategories.game_id')
        ->select('*','totalcategories.category_id as cat_id')->get();
        return $data;
    }
    public function getTotalPlatformData(){
        $data=DB::table('games')
        ->join('totalplatforms','games.id','totalplatforms.game_id')
        ->select("*")->get();
        return $data;
    }
    public function gotPlatformById($id){
       $data=Platform::where('id',$id)->pluck('platform')->toArray();
       return $data;
    }
    public function getProductsPaginate($platform){
       $data=Game::where('platform',$platform)->paginate(10);
       return $data;
    }
    public function getAllGamesByCatId($platform,$id){
        $data=DB::table('games')->join('totalcategories as TC','games.id','TC.game_id')
        ->where('TC.category_id',$id)
        ->where('games.platform',$platform->platform)
        ->select('games.*')
        ->get();
        return $data;
    }
    public function getCartGamesById($id){
        $data=DB::table('games')
        ->join('carts','games.id','carts.game_id')
        ->select('games.*','carts.qty as cartqty','carts.id as cartid')
        ->where('carts.user_id',$id)
        ->get();
        return $data;
    }
    public function getDatasByUserId($uid){
        // $data=DB::table('games')->leftJoin('carts','games.id','carts.game_id')
        // ->select('games.*','carts.qty as cartqty')
        // ->orderBy('created_at','desc')->get();
        $data=Game::orderBy('created_at','desc')->get();
        return $data;
    }
    public function getTooManyProducts($platform){
        $data=Game::where('platform',$platform)->get();
        return $data;
    }
}