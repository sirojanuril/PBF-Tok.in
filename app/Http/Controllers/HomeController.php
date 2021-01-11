<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

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
    public function halaman_utama()
    {
        $barang = Barang::latest()->paginate(6);
        return view('home', compact('barang'));
    }
}
