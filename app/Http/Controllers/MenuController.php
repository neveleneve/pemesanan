<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller {
    public function __construct() {
        $this->middleware('permission:menu index')->only('index');
        $this->middleware('permission:menu create')->only('create', 'store');
        $this->middleware('permission:menu show')->only('show');
        $this->middleware('permission:menu edit')->only('edit', 'update');
        $this->middleware('permission:menu delete')->only('destroy', 'restore');
    }

    public function index() {
        confirmDelete('Hapus Data Menu', 'Konfirmasi hapus data menu ini?');
        return view('user.menu.index');
    }

    public function create() {
        return view('user.menu.create');
    }

    public function store(Request $request) {
        // dd($request->all());
        $validasi = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'tipe' => ['required'],
                'harga' => ['required', 'numeric'],
                'gambar' => ['image', 'mimes:jpeg,png,jpg', 'max:512'],
            ],
            [
                'nama.required' => 'Nama menu harus diisi!',
                'tipe.required' => 'Tipe menu harus dipilih!',
                'harga.required' => 'Harga menu harus diisi!',
                'harga.numeric' => 'Harga menu harus berupa angka!',
                'gambar.image' => 'File yang diupload harus berupa gambar!',
                'gambar.mimes' => 'File yang diupload harus mempunyai format .jpg, ,jpeg, atau .png!',
                'gambar.max' => 'File yang diupload harus mempunyai ukuran tidak lebih dari 500kb!',
            ]
        );

        if ($validasi->fails()) {
            Alert::warning('Gagal', 'Gagal menambah data menu baru. Silakan ulangi!');
            return redirect(route("menu.create"))
                ->withErrors($validasi->errors())
                ->withInput();
        } else {
            $menu = Menu::create([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'tipe' => $request->tipe,
            ]);
            if ($menu) {
                if ($request->hasFile('gambar')) {
                    $imageName = $request->nama . '-' . time() . '.' . $request->gambar->extension();
                    $request->gambar->storeAs('public/images/menu', $imageName);
                    // Storage::disk('public')->put('images/menu/' . $imageName, $request->gambar);
                    Menu::find($menu->id)->update([
                        'images' => $imageName
                    ]);
                }
                Alert::success('Berhasil', 'Berhasil menambah data menu baru.');
                return redirect(route('menu.index'));
            } else {
                Alert::warning('Gagal', 'Gagal menambah data menu baru. Silakan ulangi!');
                return redirect(route("menu.create"))->withInput();
            }
        }
    }

    public function show(Menu $menu) {
        return view('user.menu.show', [
            'data' => $menu
        ]);
    }

    public function edit(Menu $menu) {
        $menu->withTrashed();
        return view('user.menu.edit', [
            'data' => $menu
        ]);
    }

    public function update(Request $request, Menu $menu) {
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

    public function destroy(Menu $menu) {
        $menus = $menu->delete();
        if ($menus) {
            $menu->update([
                'status' => 0
            ]);
            Alert::success('Berhasil', 'Berhasil menghapus data menu.');
        } else {
            Alert::warning('Gagal', 'Gagal menghapus data menu.');
        }
        return redirect(route('menu.index'));
    }

    public function restore($menu) {
        $menus = Menu::withTrashed()
            ->find($menu)
            ->restore();
        if ($menus) {
            Alert::success('Berhasil', 'Berhasil mengembalikan data menu.');
        } else {
            Alert::warning('Gagal', 'Gagal mengembalikan data menu.');
        }
        return redirect(route('menu.index'));
    }
}
