<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\PermissionDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Konfigurasi\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(PermissionDataTable $permissionDataTable)
    {
        $title = 'Konfigurasi Permission';
        return $permissionDataTable->render('pages.konfigurasi.permission', compact('title'));
    }

    public function create()
    {
        return view('pages.konfigurasi.permission-form', [
            'data' => new Permission(),
            'action' => route('konfigurasi.permissions.store'),
        ]);
    }

    public function store(PermissionRequest $request)
    {
        $permission = new Permission($request->validated());

        $permission->save();

        return responseSuccess();
    }

    public function show(Permission $permission)
    {
        return view('pages.konfigurasi.permission-form', [
            'data' => $permission
        ]);
    }

    public function edit(Permission $permission)
    {
        return view('pages.konfigurasi.permission-form', [
            'data' => $permission,
            'action' => route('konfigurasi.permissions.update', $permission->id),
        ]);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->fill($request->validated());

        $permission->save();

        return responseSuccess(true);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return responseSuccessDelete();
    }
}
