<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Totalcategory extends Model
{
    use HasFactory;
    protected $fillable=['game_id','category_id'];
    function game(){
        return $this->belongsTo(Game::class);
    }
}
