<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\MenuDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Konfigurasi\MenuRequest;
use App\Models\Konfigurasi\Menu;
use App\Models\Permission;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Mavinoo\Batch\BatchFacade;

class MenuController extends Controller
{

    function __construct(private MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    function index(MenuDataTable $menuDataTable)
    {
        $title = 'Konfigurasi Menu';
        $this->authorize('read konfigurasi/menu');
        return $menuDataTable->render('pages.konfigurasi.menu', compact('title'));
    }

    function sort()
    {
        $menus = $this->repository->getMenus();

        $data = [];
        $i = 0;
        foreach ($menus as $mm) {
            $i++;
            $data[] = ['id' => $mm->id, 'orders' => $i];
            foreach ($mm->subMenus as $sm) {
                $i++;
                $data[] = ['id' => $sm->id, 'orders' => $i];
            }
        }

        Cache::forget('menus');

        BatchFacade::update(new Menu(), $data, 'id');
        responseSuccess(true);
    }

    function create(Menu $menu)
    {
        $this->authorize('create konfigurasi/menu');

        return view('pages.konfigurasi.menu-form', [
            'action' => route('konfigurasi.menu.store'),
            'data' => $menu,
            'mainMenus' => $this->repository->getMainMenus(),
        ]);
    }

    private function fillData(MenuRequest $request, Menu $menu)
    {
        $menu->fill($request->validated());
        $menu->fill([
            'orders' => $request->orders,
            'icon' => $request->icon,
            'category' => $request->category,
            'main_menu_id' => $request->main_menu
        ]);
    }

    function store(MenuRequest $request, Menu $menu)
    {
        DB::beginTransaction();
        try {
            $this->authorize('create konfigurasi/menu');

            $this->fillData($request, $menu);

            $menu->save();

            foreach ($request->permissions ?? [] as $permission) {
                Permission::create([
                    'name' => $permission . " {$menu->url}"
                ])->menus()->attach($menu);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return responseError($th);
        }

        return responseSuccess();
    }

    function show(Menu $menu)
    {
        //
    }

    function edit(Menu $menu)
    {
        $this->authorize('update konfigurasi/menu');

        return view('pages.konfigurasi.menu-form', [
            'action' => route('konfigurasi.menu.update', $menu->id),
            'data' => $menu,
            'mainMenus' => $this->repository->getMainMenus(),
        ]);
    }

    function update(MenuRequest $request, Menu $menu)
    {
        $this->authorize('update konfigurasi/menu');

        $this->fillData($request, $menu);

        if ($request->level_menu == 'main_menu') {
            $menu->main_menu_id = null;
        }

        $menu->save();

        // return view('pages.konfigurasi.menu-form', [
        //     'action' => route('konfigurasi.menu.store'),
        //     'data' => $menu,
        //     'mainMenus' => $this->repository->getMainMenus(),
        // ]);
        return responseSuccess(true);
    }

    function destroy(Menu $menu)
    {
        //
    }
}
