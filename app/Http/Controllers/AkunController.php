<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Alert;
use Carbon;
use App\User;


class AkunController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tampilan_akun()
    {
    	$user = User::where('id', Auth::user()->id)->first();

    	return view('akun.akun_pengguna', compact('user'));
    }

    public function update_akun(Request $request)
	{
		$now = Carbon\Carbon::now();

		 $this->validate($request, [
	        'password'  	=> 'confirmed',
	        'no_hp'			=> 'required|min:10|max:13',
	        'alamat'		=> 'required|max:50',
	        'name'			=> 'required|max:15',
	        'jenis_kelamin' => 'required',
	        'tanggal_lahir'	=> 'required',
	        'foto_akun'		=> 'mimes:jpeg,png,jpg|max:2048',
	    ]);

		$user = User::where('id', Auth::user()->id)->first();
		$user->name 		 = $request->name;
		$user->no_hp 		 = $request->no_hp;
		$user->email 		 = $request->email;
		$user->alamat 		 = $request->alamat;
		$user->jenis_kelamin = $request->jenis_kelamin;
		$user->tanggal_lahir = $request->tanggal_lahir;

		if ($request->hasfile('foto_akun')) {
            $foto         = $request->file('foto_akun');
            $new_foto     = rand().'.'.$foto->getClientOriginalExtension();
            $foto->storeAs('profil', $new_foto);
            $user->foto_akun = $new_foto;
        }
		
        if ($request->tanggal_lahir > $now) {
        	return redirect('akun')->with('danger', 'Tanggal lahir tidak valid');
        }

		if(!empty($request->password))
		{
			$user->password = Hash::make($request->password);
		}
		
		$user->update();

		return redirect('akun')->with('success', 'Data akun berhasil diupdate');
	}
}
