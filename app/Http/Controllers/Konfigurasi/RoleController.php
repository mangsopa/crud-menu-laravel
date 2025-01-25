<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Konfigurasi\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(RoleDataTable $roleDataTable)
    {
        $title = 'Konfigurasi Role';
        return $roleDataTable->render('pages.konfigurasi.role', compact('title'));
    }

    public function create()
    {
        return view('pages.konfigurasi.role-form', [
            'data' => new Role(),
            'action' => route('konfigurasi.roles.store',),
        ]);
    }

    public function store(RoleRequest $request)
    {
        $role = new Role($request->validated());

        $role->save();

        return responseSuccess();
    }

    public function show(Role $role)
    {
        return view('pages.konfigurasi.role-form', [
            'data' => $role
        ]);
    }

    public function edit(Role $role)
    {
        return view('pages.konfigurasi.role-form', [
            'data' => $role,
            'action' => route('konfigurasi.roles.update', $role->id),
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->fill($request->validated());

        $role->save();

        return responseSuccess(true);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return responseSuccessDelete();
    }
}
