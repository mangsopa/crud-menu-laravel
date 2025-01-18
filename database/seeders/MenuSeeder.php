<?php

namespace Database\Seeders;

use App\Models\Konfigurasi\Menu;
use App\Models\Permission;
use App\Traits\HasMenuPermission;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    use HasMenuPermission;

    public function run(): void
    {
        /**
         * @var Menu $mm
         */

        // $mm = Main Menu
        $mm = Menu::firstOrCreate(['url' => 'konfigurasi'], [
            'name' => 'konfigurasi',
            'category' => 'MASTER DATA',
            'active' => true,
            'icon' => 'fas fa-cogs',
        ]);

        $this->attachMenupermission($mm, ['read'], ['admin']);

        // $sm = Sub Menu
        $sm = $mm->subMenus()->create([
            'name' => 'Menu',
            'url' => $mm->url . '/menu',
            'category' => $mm->category,
        ]);

        $this->attachMenupermission($sm, null, ['admin']);
    }
}
