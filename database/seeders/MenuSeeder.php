<?php

namespace Database\Seeders;

use App\Models\Konfigurasi\Menu;
use App\Traits\HasMenuPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class MenuSeeder extends Seeder
{
    use HasMenuPermission;

    public function run(): void
    {
        Cache::forget('menus');
        /**
         * @var Menu $mm
         */

        $mm = Menu::firstOrCreate(['url' => 'dashboard'], [
            'name' => 'Dashboard',
            'active' => true,
            'icon' => 'home',
        ]);
        $this->attachMenupermission($mm, ['read'], ['admin']);

        // $mm = Main Menu
        $mm = Menu::firstOrCreate(['url' => 'konfigurasi'], [
            'name' => 'Konfigurasi',
            'category' => 'SETTINGS',
            'active' => true,
            'icon' => 'settings',
        ]);
        $this->attachMenupermission($mm, ['read'], ['admin']);

        // $sm = Sub Menu
        $sm = $mm->subMenus()->create([
            'name' => 'Menu',
            'url' => $mm->url . '/menu',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, ['create', 'read', 'update', 'delete', 'sort'], ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Roles',
            'url' => $mm->url . '/roles',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, ['create', 'read', 'update', 'delete'], ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Permissions',
            'url' => $mm->url . '/permissions',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, ['create', 'read', 'update', 'delete'], ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Akses Role',
            'url' => $mm->url . '/akses-role',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, ['read', 'update'], ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Akses Users',
            'url' => $mm->url . '/akses-user',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, ['read', 'update'], ['admin']);
    }
}
