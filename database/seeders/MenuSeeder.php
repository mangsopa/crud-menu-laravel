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

        $mm = Menu::firstOrCreate(['url' => 'manajemen-pesanan'], [
            'name' => 'Daftar Pesanan',
            'category' => 'MASTER PESANAN',
            'active' => true,
            'icon' => 'file-text',
        ]);
        $this->attachMenupermission($mm, ['read'], ['admin']);

        $mm = Menu::firstOrCreate(['url' => 'manajemen-produk'], [
            'name' => 'Manajemen Produk',
            'category' => 'MASTER DATA',
            'active' => true,
            'icon' => 'menu',
        ]);
        $this->attachMenupermission($mm, ['read'], ['admin']);

        // $sm = Sub Menu
        $sm = $mm->subMenus()->create([
            'name' => 'Produk',
            'url' => $mm->url . '/produk',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Kategori Produk',
            'url' => $mm->url . '/category-product',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Stok',
            'url' => $mm->url . '/stock',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Harga',
            'url' => $mm->url . '/price',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Promosi dan Diskon',
            'url' => $mm->url . '/promosi-diskon',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);

        $mm = Menu::firstOrCreate(['url' => 'manajemen-laporan'], [
            'name' => 'Laporan',
            'category' => 'MASTER LAPORAN',
            'active' => true,
            'icon' => 'file',
        ]);
        $this->attachMenupermission($mm, ['read'], ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Laporan Penjualan',
            'url' => $mm->url . '/laporan-penjualan',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Laporan Produk',
            'url' => $mm->url . '/laporan-produk',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);

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
            'name' => 'Users',
            'url' => $mm->url . '/akses-user',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, ['read', 'update'], ['admin']);

        // $sm = Sub Menu
        $sm = $mm->subMenus()->create([
            'name' => 'Payment',
            'url' => $mm->url . '/payment',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);

        // $mm = Main Menu
        $mm = Menu::firstOrCreate(['url' => 'support-help'], [
            'name' => 'Attention List',
            'category' => 'SETTINGS',
            'active' => true,
            'icon' => 'info',
        ]);
        $this->attachMenupermission($mm, ['read'], ['admin']);

        // $sm = Sub Menu
        $sm = $mm->subMenus()->create([
            'name' => 'Live Chat Support',
            'url' => $mm->url . '/live-chat',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'FAQ',
            'url' => $mm->url . '/faq',
            'category' => $mm->category,
        ]);
        $this->attachMenupermission($sm, null, ['admin']);
    }
}
