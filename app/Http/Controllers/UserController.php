<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user index')->only('index');
        $this->middleware('permission:user create')->only('create', 'store');
        $this->middleware('permission:user show')->only('show');
        $this->middleware('permission:user edit')->only('edit', 'update');
        $this->middleware('permission:user delete')->only('destroy', 'restore');
    }

    public function index()
    {
        confirmDelete('Hapus Data Pengguna', 'Konfirmasi hapus data pengguna ini?');
        return view('user.user.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        return view('user.user.show', [
            'data' => $user
        ]);
    }

    public function edit(User $user)
    {
        $role = Role::get();
        return view('user.user.edit', [
            'data' => $user,
            'role' => $role,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validasi = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'email' => ['required', 'email'],
                'role' => ['required'],
            ],
            [
                'nama.required' => 'Nama pengguna harus diisi!',
                'email.required' => 'Email pengguna harus dipilih!',
                'email.email' => 'Email pengguna harus dengan format email!',
                'role.required' => 'Role pengguna harus dipilih!',
            ]
        );

        if ($validasi->fails()) {
            Alert::warning('Gagal', 'Gagal mengubah data menu. Silakan ulangi!');
            return redirect(route('user.edit', ['user' => $user->id]))
                ->withErrors($validasi->errors())
                ->withInput();
        } else {
            $users = $user->update([
                'name' => $request->nama,
                'email' => $request->email,
            ]);
            if ($users) {
                $user->syncRoles([$request->role]);
                Alert::success('Berhasil', 'Berhasil mengubah data pengguna.');
                return redirect(route('user.index'));
            } else {
                Alert::warning('Gagal', 'Gagal mengubah data menu. Silakan ulangi!');
                return redirect(route("user.edit", ['user' => $user->id]))
                    ->withInput();
            }
        }
    }

    public function destroy(User $user)
    {
        $users = $user->delete();
        if ($users) {
            Alert::success('Berhasil', 'Berhasil menghapus data pengguna.');
        } else {
            Alert::warning('Gagal', 'Gagal menghapus data pengguna.');
        }
        return redirect(route('user.index'));
    }

    public function restore($user)
    {
        $users = User::withTrashed()
            ->find($user)
            ->restore();
        if ($users) {
            Alert::success('Berhasil', 'Berhasil mengembalikan data pengguna.');
        } else {
            Alert::warning('Gagal', 'Gagal mengembalikan data pengguna.');
        }
        return redirect(route('user.index'));
    }
}
