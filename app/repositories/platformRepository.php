<?php
namespace App\repositories;

use App\interfaces\platformInterface;
use App\Models\Game;
use App\Models\Platform;
use App\Models\Totalplatform;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class platformRepository implements platformInterface{
    public function add($platform){
        $data=new Platform();
        $data->platform=$platform->platform;
        $data->save();
    }
    public function get()
    {
        $data=Platform::all();
        return $data;
    }
    public function del($id){
        $data=Platform::find($id);
        $data->delete();
    }
    public function createdPlatform($platform)
    {

        foreach($platform->platforms as $plf)
        {
           
         
            $data=new Totalplatform;
            $data->game_id=$platform->game_id;
            $data->platform_id=$plf;
            $data->save();
            
           
        }
    }
    public function getPlatform($id)
    {
        $data=Totalplatform::where('game_id',$id)->get();
        return $data;
    }
    public function deletedPlatform($id)
    {
        $data=Totalplatform::find($id);
        $data->delete();
    }
    public function getPlatformWithGameId($id){
        // $data=Totalplatform::where('game_id',$id)->get();
        // return $data;
        $data=DB::table('platforms')->join('totalplatforms','platforms.id','totalplatforms.platform_id')->where('totalplatforms.game_id',$id)->select('platforms.*')->get();
        return $data;
    }
}