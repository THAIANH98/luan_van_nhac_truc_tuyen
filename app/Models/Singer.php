<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    protected $fillable =[
        'name',
        'active',
        'avatar',
        'birthday',
        'description'
    ];

    public function song_singer(){
        return $this->belongsToMany(Song::class,'songs_singers','singer_id','song_id');
    }

}
