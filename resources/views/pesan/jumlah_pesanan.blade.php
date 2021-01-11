@extends('layout.master')

@section('title', 'Pesan Barang')

@section('content')
<section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Pesan Barang</h2>
                    <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
    <div class="row">
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang }}</li>
              </ol>
            </nav>
        </div>
        <div class="col-md-12 mt-1">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/thumbnail/'.$barang->gambar) }}" class="rounded mx-auto d-block" width="100%" alt="">
                        </div>
                        <div class="col-md-6 mt-5">
                            <h2>{{ $barang->nama_barang }}</h2>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Harga Barang</td>
                                        <td>:</td>
                                        <td>Rp. {{ number_format($barang->harga_barang) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok Barang</td>
                                        <td>:</td>
                                        <td>{{ $barang->stok_barang }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $barang->keterangan }}</td>
                                    </tr>

                                    
                                    <tr>
                                        <td>Jumlah Beli</td>
                                        <td>:</td>
                                        <td>
                                            <form action="{{ url('pesan') }}/{{ $barang->id }}" method="post">
                                            @csrf
                                                <input type="number" min="0" name="jumlah_pesan" class="form-control" required=""> <!-- request jumlah_pesan -->
                                                <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-shopping-cart"></i> Beli Sekarang</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
