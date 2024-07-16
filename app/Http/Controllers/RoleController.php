<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role) {
        $permission = Permission::get();
        return view('user.role.edit', [
            'role' => $role,
            'role_permission' => $role->getAllPermissions(),
            'permissions' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role) {
        $update = $role->syncPermissions($request->permissions);
        if ($update) {
            Alert::success('Berhasil', 'Berhasil mengubah hak akses role!');
            return redirect(route('role.edit', ['role' => $role->id]));
        } else {
            Alert::warning('Gagal', 'Gagal mengubah data hak akses role. Silakan ulangi!');
            return redirect(route('role.edit', ['role' => $role->id]));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role) {
        //
    }
}
