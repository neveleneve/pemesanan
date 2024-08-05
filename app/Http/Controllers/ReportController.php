<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReportController extends Controller {
    public function __construct() {
        $this->middleware('permission:report index')->only('index');
    }

    public function index() {
        return view('user.report.index');
    }

    public function cetak(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'jenis' => ['required'],
            'tanggal' => ['required_if:jenis,harian'],
            'bulan' => ['required_if:jenis,bulanan'],
            'tahun' => ['required_if:jenis,bulanan,tahunan'],
        ]);

        if ($validator->fails()) {
            return view('errors.cetak_failed');
        } else {
            if ($request->jenis == 'harian') {
                return redirect(route('report.hari', ['tanggal' => $request->tanggal]));
            } elseif ($request->jenis == 'bulanan') {
                return redirect(route('report.bulan', ['bulan' => $request->bulan, 'tahun' => $request->tahun]));
            } elseif ($request->jenis == 'tahunan') {
                return redirect(route('report.tahun', ['tahun' => $request->tahun]));
            } else {
                return view('errors.cetak_failed');
            }
        }
    }

    public function hari(Request $request) {
        $validate = Validator::make($request->all(), [
            'tanggal' => ['required', 'date']
        ]);

        if ($validate->fails()) {
            return view('errors.cetak_failed');
        } else {
            $data = Transaksi::whereDate('created_at', $request->tanggal)
                ->get();
            $pdf = PDF::loadView('report.harian', [
                'data' => $data,
                'tanggal' => date('d F Y', strtotime($request->tanggal)),
            ]);
            return $pdf->stream('Laporan Transaksi Harian - ' . date('d F Y', strtotime($request->tanggal)) . '.pdf');
        }
    }

    public function bulan(Request $request) {
        $validate = Validator::make($request->all(), [
            'bulan' => ['required', 'numeric'],
            'tahun' => ['required', 'numeric']
        ]);

        if ($validate->fails()) {
            return view('errors.cetak_failed');
        } else {
            $data = Transaksi::whereMonth('created_at', $request->bulan)
                ->whereYear('created_at', $request->tahun)
                ->get();
            $pdf = PDF::loadView('report.bulanan', [
                'data' => $data,
                'bulan_tahun' => $this->namaBulan($request->bulan) . ' ' . $request->tahun,
            ]);
            return $pdf->stream('Laporan Transaksi Bulanan - ' . $this->namaBulan($request->bulan) . ' ' . $request->tahun . '.pdf');
        }
    }
    public function tahun(Request $request) {
        $validate = Validator::make($request->all(), [
            'tahun' => ['required', 'numeric']
        ]);

        if ($validate->fails()) {
            return view('errors.cetak_failed');
        } else {
            $data = Transaksi::whereYear('created_at', $request->tahun)
                ->get();
            $pdf = PDF::loadView('report.tahunan', [
                'data' => $data,
                'tahun' => $this->namaBulan($request->bulan) . ' ' . $request->tahun,
            ]);
            return $pdf->stream('Laporan Transaksi Tahunan - Tahun ' . $request->tahun . '.pdf');
        }
    }

    public function namaBulan($id) {
        switch ($id) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;

            default:
                return '';
                break;
        }
    }
}
