<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'menu_id',
        'category_id',
        'thumb',
        'active',
        'user_id',
        'view',
        'description',
    ];

    public function playlist_song(){
        return $this->belongsToMany(Song::class,'song_playlist','playlist_id','song_id');
    }

    public function  menu_playlist(){
        return $this->hasOne(Menu::class,'id','menu_id');
    }

    public function  cate_playlist(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
