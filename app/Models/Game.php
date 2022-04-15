<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Totalcategory;

class Game extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'name',
        'release_date',
        'publisher',
        'developer',
        'rated',
        'game_mode',
        'price',
        'qty',
        'discount',
        'image',
        'platform',
        'image_item',
        'description'];
    public function totalplatforms()
    {
        return $this->hasMany(Totalplatform::class);
    }
    public function categories()
    {
        return $this->hasMany(Totalcategory::class);
    }
}
