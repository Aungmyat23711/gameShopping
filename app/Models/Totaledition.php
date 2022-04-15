<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Totaledition extends Model
{
    use HasFactory;
    protected $fillable=['game_id','edition_id'];
    function game()
    {
        $this->belongsTo(Game::class);
    }
}
