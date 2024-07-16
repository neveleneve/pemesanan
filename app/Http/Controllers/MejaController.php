<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MejaController extends Controller {
    public function __construct() {
        $this->middleware('permission:meja index')->only('index');
        $this->middleware('permission:meja create')->only('create', 'store');
        $this->middleware('permission:meja show')->only('show');
        $this->middleware('permission:meja edit')->only('edit', 'update');
        $this->middleware('permission:meja delete')->only('destroy', 'restore');
    }

    public function index() {
        confirmDelete('Hapus Data Meja', 'Konfirmasi hapus data meja ini?');
        return view('user.meja.index');
    }

    public function create() {
        return view('user.meja.create');
    }

    public function store(Request $request) {
        $validasi = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'token' => ['required'],
            ],
            [
                'nama.required' => 'Nama meja harus diisi!',
                'token.required' => 'Token harus diisi!',
            ]
        );

        if ($validasi->fails()) {
            Alert::warning('Gagal', 'Gagal menambah data meja baru. Silakan ulangi!');
            return redirect(route("meja.create"))
                ->withErrors($validasi->errors())
                ->withInput();
        } else {
            $meja = Meja::create($request->all());
            if ($meja) {
                Alert::success('Berhasil', 'Berhasil menambah data meja baru.');
                return redirect(route('meja.index'));
            } else {
                Alert::warning('Gagal', 'Gagal menambah data meja baru. Silakan ulangi!');
                return redirect(route("meja.create"))->withInput();
            }
        }
    }

    public function show(Meja $meja) {
        return view('user.meja.show', [
            'data' => $meja
        ]);
    }

    public function edit(Meja $meja) {
        return view('user.meja.edit', [
            'data' => $meja
        ]);
    }

    public function update(Request $request, Meja $meja) {
        //
    }

    public function destroy(Meja $meja) {
        $mejas = $meja->delete();
        if ($mejas) {
            Alert::success('Berhasil', 'Berhasil menghapus data '  . $meja->nama . '.');
        } else {
            Alert::warning('Gagal', 'Gagal menghapus data ' . $meja->nama . '.');
        }
        return redirect(route('meja.index'));
    }

    public function restore($meja) {
        $mejas = Meja::withTrashed()
            ->find($meja)
            ->restore();
        if ($mejas) {
            Alert::success('Berhasil', 'Berhasil mengembalikan data meja.');
        } else {
            Alert::success('Gagal', 'Gagal mengembalikan data meja.');
        }
        return redirect(route('meja.index'));
    }

    public function qrCode(Meja $meja) {
        $id = $meja->id;
        $name = $meja->nama;
        $token = $meja->token;
        return response()->streamDownload(
            function () use ($id, $token) {
                echo QrCode::size(200)
                    ->format('svg')
                    ->generate(route('pesan.check', ['meja' => $id, 'token' => $token]));
            },
            'QRCode-' . $name . '.svg',
            [
                'Content-Type' => 'image/svg',
            ]
        );
    }
}
