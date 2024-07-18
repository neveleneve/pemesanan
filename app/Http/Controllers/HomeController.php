<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $todayOrderFood = DetailTransaksi::with('menu')
            ->whereDate('created_at', Carbon::today())
            ->whereHas('menu', function ($q) {
                $q->where('tipe', 'makanan');
            })
            ->sum('qty');
        $todayOrderDrink = DetailTransaksi::with('menu')
            ->whereDate('created_at', Carbon::today())
            ->whereHas('menu', function ($q) {
                $q->where('tipe', 'minuman');
            })
            ->sum('qty');
        return view('user.dashboard.index', [
            'todayFood' => $todayOrderFood,
            'todayDrink' => $todayOrderDrink
        ]);
    }
}
