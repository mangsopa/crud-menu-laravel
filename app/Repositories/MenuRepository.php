<?php

namespace App\Repositories;

use App\Models\Konfigurasi\Menu;

class MenuRepository
{
    function getMainMenus()
    {
        return Menu::whereNull('main_menu_id')->select('id', 'name')->get();
    }
}
