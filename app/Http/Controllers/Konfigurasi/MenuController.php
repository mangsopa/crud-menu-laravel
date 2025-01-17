<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\MenuDataTable;
use App\Http\Controllers\Controller;
use App\Models\Konfigurasi\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(MenuDataTable $menuDataTable)
    {
        $title = 'Konfigurasi Menu';
        return $menuDataTable->render('pages.konfigurasi.menu', compact('title'));
        // $menus = Menu::all();
        // return view('pages.konfigurasi.menu', compact('menus'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        //
    }

    public function update(Request $request, Menu $menu)
    {
        //
    }

    public function destroy(Menu $menu)
    {
        //
    }
}
