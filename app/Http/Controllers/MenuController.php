<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete('Hapus Data Menu', 'Konfirmasi hapus data menu ini?');
        return view('user.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'tipe' => ['required'],
                'harga' => ['required', 'numeric'],
            ],
            [
                'nama.required' => 'Nama menu harus diisi!',
                'tipe.required' => 'Tipe menu harus dipilih!',
                'harga.required' => 'Harga menu harus diisi!',
                'harga.numeric' => 'Harga menu harus berupa angka!',
            ]
        );

        if ($validasi->fails()) {
            Alert::warning('Gagal', 'Gagal menambah data menu baru. Silakan ulangi!');
            return redirect(route("menu.create"))
                ->withErrors($validasi->errors())
                ->withInput();
        } else {
            $menu = Menu::create($request->all());
            if ($menu) {
                Alert::success('Berhasil', 'Berhasil menambah data menu baru.');
                return redirect(route('menu.index'));
            } else {
                Alert::warning('Gagal', 'Gagal menambah data menu baru. Silakan ulangi!');
                return redirect(route("menu.create"))->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('user.menu.show', [
            'data' => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $menu->withTrashed();
        return view('user.menu.edit', [
            'data' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validasi = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'tipe' => ['required'],
                'harga' => ['required', 'numeric'],
                'status' => ['required'],
            ],
            [
                'nama.required' => 'Nama menu harus diisi!',
                'tipe.required' => 'Tipe menu harus dipilih!',
                'harga.required' => 'Harga menu harus diisi!',
                'harga.numeric' => 'Harga menu harus berupa angka!',
            ]
        );

        if ($validasi->fails()) {
            Alert::warning('Gagal', 'Gagal mengubah data menu. Silakan ulangi!');
            return redirect(route("menu.edit", ['menu' => $menu->id]))
                ->withErrors($validasi->errors())
                ->withInput();
        } else {
            $menus = $menu->update($request->all());
            if ($menus) {
                Alert::success('Berhasil', 'Berhasil mengubah data menu.');
                return redirect(route('menu.index'));
            } else {
                Alert::warning('Gagal', 'Gagal mengubah data menu. Silakan ulangi!');
                return redirect(route("menu.edit", ['menu' => $menu->id]))
                    ->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menus = $menu->delete();
        if ($menus) {
            $menu->update([
                'status' => 0
            ]);
            Alert::success('Berhasil', 'Berhasil menghapus data menu.');
        } else {
            Alert::success('Gagal', 'Gagal menghapus data menu.');
        }
        return redirect(route('menu.index'));
    }

    public function restore($menu)
    {
        $menus = Menu::withTrashed()
            ->find($menu)
            ->restore();
        if ($menus) {
            Alert::success('Berhasil', 'Berhasil mengembalikan data menu.');
        } else {
            Alert::success('Gagal', 'Gagal mengembalikan data menu.');
        }
        return redirect(route('menu.index'));
    }
}
