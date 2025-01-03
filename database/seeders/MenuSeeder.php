<?php

namespace Database\Seeders;

use App\Models\Konfigurasi\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * @var Menu $mm
         */
        $mm = Menu::firstOrCreate([
            'name' => 'konfigurasi',
            'url' => 'konfigurasi',
            'category' => 'MASTER DATA',
            'active' => true,
            'icon' => 'fas fa-cogs',
        ]);
        // $this->attachMenupermission($mm, ['read'], ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Menu',
            'url' => $mm->url . '/menu',
            'category' => $mm->category,
        ]);
        // $this->attachMenupermission($sm, ['read', 'create', 'update', 'delete'], ['admin']);
    }
}
