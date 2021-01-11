<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class HalamanController extends Controller
{
    public function landingpage()
    {

    	$barang = Barang::latest()->paginate(3);

      	return view('welcome', compact('barang'));
    }
}
