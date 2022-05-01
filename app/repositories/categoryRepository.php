<?php
namespace App\repositories;

use App\interfaces\categoryInterface;
use App\Models\Category;
use App\Models\Game;
use App\Models\Totalcategory;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class categoryRepository implements categoryInterface{
    public function add($category){
        $data=new Category();
        $data->category=$category->category;
        $data->save();
    }
    public function get()
    {
        $data=Category::all();
        return $data;
    }
    public function del($id){
        $data=Category::find($id);
        $data->delete();
    }
    public function addCategory($category)
    {
        foreach($category->categories as $cat)
        {
            // if(Game::find($category->game_id) && Totalcategory::find($cat)){
            // return response()->json(['msg'=>'Already Inserted']);   
            // }else{
            $data=new Totalcategory();
            $data->game_id=$category->game_id;
            $data->category_id=$cat;
            $data->save();
            // }
           
        }
    }
    public function getCategory($id)
    {
        $data=Totalcategory::where('game_id',$id)->get();
        return $data;
    }
    public function deletedCategory($id)
    {
        $data=Totalcategory::find($id);
        $data->delete();
    }
    public function getCategoryById($id){
       $data=DB::table('totalCategories as TC')->join('categories','TC.category_id','categories.id')->where('TC.game_id',$id)->select('categories.*')->get();
       return $data;
    }
    public function getAllTCount($platform){
        $data=DB::table('games')->where('platform',$platform)->join('totalcategories as TC','games.id','TC.game_id')
        ->select('TC.*')->get();
        return $data;
    }
    public function getAllCountByPlatform($platform){
        $data=Game::where('platform',$platform)->count();
        return $data;
    }
}