<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $recentabsen = Absensi::orderBy('id','DESC')->limit('5')->get();
        $terlambat = Absensi::where('status','Terlambat')->whereDate('created_at', Carbon::today())->count();
        $tepat = Absensi::where('status','Tepat Waktu')->whereDate('created_at', Carbon::today())->count();

        return view('home', compact('recentabsen','terlambat', 'tepat'));
    }

}
