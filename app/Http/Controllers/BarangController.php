<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Image;
use Auth;
use App\Barang;
use App\User;

class BarangController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {	
    	return view('barang.tambah_barang');
    }

    public function create(Request $request)
    {
    	$pengguna = User::where('id', Auth::user()->id)->first();

    	$request->validate([
    		'nama_barang' 	=> 'required|max:15',
    		'harga_barang' 	=> 'required|min:3|max:10',
    		'stok_barang' 	=> 'required|max:10',
    		'keterangan' 	=> 'required|max:50',
    		'gambar' 		=> 'required|mimes:jpeg,png,jpg|max:2048',
    	]);

    	$gambar = $request->file('gambar');
    	$new_gambar = rand().'.'.$gambar->getClientOriginalExtension();

    	$barang = array(
    		'nama_barang' 	=> $request->nama_barang,
    		'harga_barang' 	=> $request->harga_barang,
    		'keterangan' 	=> $request->keterangan,
    		'stok_barang' 	=> $request->stok_barang,
    		'gambar' 		=> $new_gambar
    	);

        if ($request->stok_barang == 0) {
            return redirect('barang')->with('danger', 'Stok barang tidak boleh 0');
        }

        $gambar->storeAs('thumbnail', $new_gambar);

        
    	Barang::create($barang);

    	return redirect('home')->with('success', 'Data barang baru berhasil ditambahkan');
    }

    public function edit($id)
    {
    	$barang = Barang::find($id);
    	return view('barang/edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
    	$gambar_lama 	= $request->hidden_gambar;
    	$gambar 		= $request->file('gambar');


    	if ($gambar != '') 
    	{
    		$request->validate([
	    		'nama_barang' 	=> 'required|max:15',
	    		'harga_barang' 	=> 'required|min:3|max:10',
	    		'keterangan' 	=> 'required|max:50',
	    		'stok_barang' 	=> 'required|max:10',
	    		'gambar' 		=> 'required|mimes:jpeg,png,jpg|max:2048',
	    	]);

	    	$gambar_name = $gambar_lama;
	    	$gambar->storeAs('thumbnail', $gambar_name);
            
    	}else{
    		$request->validate([
    			'nama_barang' 	=> 'required|max:15',
	    		'harga_barang' 	=> 'required|max:10',
	    		'keterangan' 	=> 'required|max:50',
	    		'stok_barang' 	=> 'required|max:10',
    		]);

    		$gambar_name = $gambar_lama;
    	}

    	$barang = Barang::where('id', $request->id)->first();
        $barang->nama_barang    = $request->nama_barang;
        $barang->harga_barang   = $request->harga_barang;
        $barang->stok_barang    = $request->stok_barang;
        $barang->keterangan     = $request->keterangan;
        $barang->gambar         = $gambar_name;

        if ($request->stok_barang == 0) {
            return redirect('barang/edit/'.$id)->with('danger', 'Stok Barang tidak boleh 0');
        }

        if ($request->harga_barang == 0) {
            return redirect('barang/edit/'.$id)->with('danger', 'Harga Barang tidak boleh 0');
        }

        $barang->update();

    	return redirect('home')->with('success', 'Data barang berhasil diupdate');
    }

    public function delete($id)
    {
        $barang = Barang::find($id);
        Storage::delete('thumbnail/'.$barang->gambar);
        $barang->delete();

        return redirect('home')->with('success', 'Data barang berhasil dihapus');        
    }

}
