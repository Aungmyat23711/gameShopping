<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;


class Photo extends Model
{
    use HasFactory;
    protected $fillable=['game_id','photo'];
    function game(){
        $this->belongsTo(Game::class);
    }
}
