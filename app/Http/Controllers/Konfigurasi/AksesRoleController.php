<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Konfigurasi\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class AksesRoleController extends Controller
{
    private function getMenus()
    {
        return Menu::with('permissions', 'subMenus.permissions')->whereNull('main_menu_id')->get();
    }

    function index(RoleDataTable $roleDataTable)
    {
        $title = 'Akses Role';
        return $roleDataTable->render('pages.konfigurasi.akses-role', compact('title'));
    }

    function show(Role $role)
    {
        //
    }

    function edit(Role $role)
    {
        $roles = Role::where('id', '!=', $role->id)->get()->pluck('id', 'name');
        return view('pages.konfigurasi.akses-role-form', [
            'data' => $role,
            'action' => route('konfigurasi.akses-role.update', $role->id),
            'menus' => $this->getMenus(),
            'roles' => $roles
        ]);
    }

    function getPermissionsByRole(Role $role)
    {
        return view('pages.konfigurasi.akses-role-items', [
            'data' => $role,
            'menus' => $this->getMenus()
        ]);
    }

    function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions);

        return responseSuccess(true);
    }
}
