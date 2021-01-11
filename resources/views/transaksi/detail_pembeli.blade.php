@extends('layout.master')

@section('title', 'Detail Pembelian')

@section('content')
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            @if(auth()->user()->level == 'admin')
            <h2 class="section-heading text-uppercase">Detail Pesanan</h2>
            @else
            <h2 class="section-heading text-uppercase">Detail Pembelian</h2>
            @endif
            <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    @if(auth()->user()->level == 'admin')
                    <li class="breadcrumb-item"><a href="{{ url('pesanan') }}">Pesanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                    @else
                    <li class="breadcrumb-item"><a href="{{ url('riwayat') }}">Riwayat Pembelian</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pembelian</li>
                    @endif
                  </ol>
                </nav>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                    <div class="card shadow p-3 mb-5 text-black rounded">
                        <div class="card-body">
                            <center>
                                @if(empty($user->foto_akun))
                                <img src="{{ url('img/default.jpg') }}" style="width: 200px; height: 200px; border-radius: 50%; border-style: groove;" alt="User" title="{{ Auth::user()->name }}">
                                @else
                                <img src="{{ asset('storage/profil/'.$user->foto_akun) }}" style="width: 200px; height: 200px; border-radius: 50%; border-style: groove;" alt="User" title="{{ Auth::user()->name }}">
                                @endif
                            </center>
                            
                            <table class="table table-hover mt-2 text-black">
                                <tbody>
                                    <tr>
                                        <td class="text-md-right"><b>Nama</b></td>
                                        <td width="10">:</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-md-right"><b>Email</b></td>
                                        <td>:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-md-right"><b>No HP</b></td>
                                        <td>:</td>
                                        <td>
                                            0{{ $user->no_hp }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-md-right"><b>Jenis Kelamin</b></td>
                                        <td>:</td>
                                        <td>
                                            {{ $user->jenis_kelamin }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-md-right"><b>Tanggal Lahir</b></td>
                                        <td>:</td>
                                        <td>
                                            {{ date('d M Y', strtotime($user->tanggal_lahir)) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-md-right"><b>Alamat</b></td>
                                        <td>:</td>
                                        <td> 
                                            {{$user->alamat}} 
                                        </td>
                                    </tr>
                                </tbody> 
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
