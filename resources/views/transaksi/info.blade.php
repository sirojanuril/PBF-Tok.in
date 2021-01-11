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
            <div class="col-md-12">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        @if(!empty($pesanan))
                            @if(auth()->user()->level == 'admin')
                            @else
                                @if($pesanan->status_pesanan == "pesan")
                                    <p>Silahkan Melakukan Pembayaran<a style="color: blue;" href="{{ url('pembayaran') }}/{{ $pesanan->id }}"> Disini</a></p>
                                @else
                                @endif
                            @endif
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesanan_detail as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($detail->pesanan->tanggal_pesanan)) }}</td>
                                    <td>{{ $detail->barang->nama_barang }}</td>
                                    <td>{{ $detail->jumlah_barang }}</td>
                                    <td>Rp. {{ number_format($detail->barang->harga_barang ) }}</td>
                                    <td>Rp. {{ number_format($detail->jumlah_harga_barang) }}</td>
                                    
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" align="right"><strong>Total :</strong></td>
                                    <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
