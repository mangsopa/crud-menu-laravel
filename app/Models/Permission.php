<?php

namespace App\Models;

use App\Models\Konfigurasi\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use HasFactory;

    function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
}
