<?php

namespace App\Models\Konfigurasi;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function subMenus()
    {
        return $this->hasMany(Menu::class, 'main_menu_id');
    }

    function permissions()
    {
        return $this->belongsToMany(Permission::class, 'menu_permission', 'menu_id', 'permission_id');
    }

    function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
