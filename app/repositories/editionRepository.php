<?php
namespace App\repositories;

use App\interfaces\editionInterface;
use App\Models\Edition;
use App\Models\Game;
use App\Models\Totaledition;

class editionRepository implements editionInterface{
    public function add($edition){
        $data=new Edition();
        $data->edition=$edition->edition;
        $data->save();
    }
    public function get()
    {
        $data=Edition::all();
        return $data;
    }
    public function del($id){
        $data=Edition::find($id);
        $data->delete();
    }
    public function createdEdition($edition)
    {

        foreach($edition->editions as $edi)
        {
            if(Game::find($edition->game_id) && Totaledition::find($edi)){
            return response()->json(['msg'=>'Already Inserted']);   
            }else{
            $data=new Totaledition();
            $data->game_id=$edition->game_id;
            $data->edition_id=$edi;
            $data->save();
            }
           
        }
    }
    public function getEdition($id)
    {
        $data=Totaledition::where('game_id',$id)->get();
        return $data;
    }
    public function deletedEdition($id)
    {
        $data=Totaledition::find($id);
        $data->delete();
    }
}