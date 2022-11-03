<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
    ];

    public function category_song(){
        return $this->hasMany(Song::class,'category_id','id');
    }

    public function category_menu(){
        return $this->belongsToMany(Menu::class,'category_menu','category_id','menu_id');
    }

}

