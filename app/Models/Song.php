<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lyric',
        'category_id',
        'user_id',
        'musican_id',
        'menu_id',
        'thumb',
        'file_song',
        'view',
        'active'
    ];

    public function song_menu(){
        return $this->hasOne(Menu::class,'id','menu_id');
    }

    public function song_cate(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function song_musican(){
        return $this->hasOne(Musican::class,'id','musican_id');
    }

    public function song_singer(){
        return $this->belongsToMany(Singer::class,'songs_singers','song_id','singer_id');
    }

    public function song_playlist(){
        return $this->belongsToMany(Playlist::class,'song_playlist','song_id','playlist_id');
    }

}
