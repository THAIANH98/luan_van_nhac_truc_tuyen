<?php

namespace App\Http\Views\Composer;

use App\Models\Menu;
use App\Models\User;
use Illuminate\View\View;

class MenuComposer
{

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $menus= Menu::where('active','=',1)->get();
        $view->with('menus',$menus);
    }
}
