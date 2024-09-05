<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Menu;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller {
    public function __construct() {
        $this->middleware('permission:transaksi index')->only('index');
        $this->middleware('guest')->only('create', 'store');
        $this->middleware('permission:transaksi show')->only('show');
        $this->middleware('permission:transaksi edit')->only('edit', 'update');
        $this->middleware('permission:transaksi delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('user.transaksi.index');
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
        $validation = Validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'meja_id' => ['required', 'numeric'],
            'meja_token' => ['required', 'string', 'min:32'],
        ]);
        if ($validation->fails()) {
            return view('errors.pesan_failed');
        } else {
            $i = 0;
            $qtyByid = [];
            foreach ($request->qtyMenu as $key => $value) {
                $data = Menu::find($key);
                $qtyByid[$i] = [
                    'id' => $data->id,
                    'harga' => $data->harga,
                    'qty' => $value,
                ];
                $i++;
            }
            $check = $this->checkQty($request->qtyMenu);
            if ($check) {
                $grandTotal = $this->getGrandTotal($qtyByid);
                $kode = Random::generate(10, '0-9a-zA-Z');
                $transaksi = Transaksi::create([
                    'meja_id' => $request->meja_id,
                    'nama' => $request->nama,
                    'kode' => $kode,
                    'total' => $grandTotal,
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                ]);
                if ($transaksi) {
                    foreach ($qtyByid as $value) {
                        if ($value['qty'] != 0) {
                            DetailTransaksi::create([
                                'transaksi_id' => $transaksi->id,
                                'menu_id' => $value['id'],
                                'harga' => $value['harga'],
                                'qty' => $value['qty'],
                                'subtotal' => $value['harga'] * $value['qty'],
                            ]);
                        }
                    }
                    return redirect(route('pesan.lihat', [
                        'kode' => $kode
                    ]))->with('alert', 1);
                }
            } else {
                return redirect(route('pesan.check', [
                    'meja' => $request->meja_id,
                    'token' => $request->meja_token
                ]));
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi) {
        //
    }

    public function report(Request $request) {
        if (isset($request->id)) {
            $transaksi = Transaksi::find($request->id);
            if ($transaksi && $transaksi->kode == $request->kode) {
                $data['transaksi'] = [
                    'meja' => $transaksi->meja->nama,
                    'kode' => $transaksi->kode,
                    'nama' => $transaksi->nama,
                    'total' => $transaksi->total,
                ];
                $detail = DetailTransaksi::where('transaksi_id', $request->id)->get();
                foreach ($detail as $key => $value) {
                    $data['menu'][$key] = [
                        'nama' => $value->menu->nama,
                        'qty' => $value->qty,
                        'status' => $value->status,
                        'harga' => $value->harga,
                        'subtotal' => $value->subtotal,
                    ];
                }
                $transaksi->update([
                    'status_bayar' => 1
                ]);
                $pdf = PDF::loadView('report.struk', $data)->setPaper('A5', 'landscape');
                return $pdf->stream('struk_' . $transaksi->kode . '-' . strtotime(date('Y-m-d H:i:s')) . '.pdf');
            } else {
                return view('errors.403');
            }
        } else {
            return view('errors.403');
        }
    }
}
