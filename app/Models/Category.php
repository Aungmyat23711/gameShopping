<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['category'];
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
