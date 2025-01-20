<?php

namespace App\Repositories;

use App\Models\Konfigurasi\Menu;

class MenuRepository
{
    function getMainMenus()
    {
        return Menu::whereNull('main_menu_id')->select('id', 'name')->get()
            ->flatMap(function ($item) {
                return [$item->name => $item->id];
            });
    }

    function getMenus()
    {
        return Menu::active()->with(['subMenus' => function ($query) {
            $query->orderBy('orders');
        }])->whereNull('main_menu_id')
            ->orderBy('orders')
            ->get();
    }
}
