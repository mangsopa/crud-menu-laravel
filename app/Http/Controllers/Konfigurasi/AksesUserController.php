<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

class AksesUserController extends Controller
{
    function __construct(protected MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function index(UserDataTable $userDataTable)
    {
        $title = 'Akses User';
        return $userDataTable->render('pages.konfigurasi.akses-user', compact('title'));
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view('pages.konfigurasi.akses-user-form', [
            'data' => $user,
            'action' => route('konfigurasi.akses-user.update', $user->id),
            'users' => User::where('id', '!=', $user->id)->pluck('id', 'name'),
            'menus' => $this->menuRepository->getMainMenuWithPermissions(),
        ]);
    }

    function getPermissionsByUser(User $user)
    {
        return view('pages.konfigurasi.akses-user-items', [
            'data' => $user,
            'menus' => $this->menuRepository->getMainMenuWithPermissions(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions);

        return responseSuccess(true);
    }
}
