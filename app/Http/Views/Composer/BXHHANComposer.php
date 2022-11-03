<?php

namespace App\Http\Views\Composer;

use App\Models\Song;
use Illuminate\View\View;

class BXHHANComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $songs= Song::where('active',1)->where('menu_id',4)->orderByDesc('view')->simplePaginate(10);
        $view->with('songs',$songs);
    }
}
