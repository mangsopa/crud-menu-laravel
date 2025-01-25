<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

class AksesRoleController extends Controller
{

    function __construct(protected MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
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
            'menus' => $this->menuRepository->getMainMenuWithPermissions(),
            'roles' => $roles
        ]);
    }

    function getPermissionsByRole(Role $role)
    {
        return view('pages.konfigurasi.akses-role-items', [
            'data' => $role,
            'menus' =>  $this->menuRepository->getMainMenuWithPermissions(),
        ]);
    }

    function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions);

        return responseSuccess(true);
    }
}
