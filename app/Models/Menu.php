<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'active',
        'parent_id',
    ];

    public function menu_category(){
        return $this->belongsToMany(Category::class,'category_menu','menu_id','category_id');
    }
}
