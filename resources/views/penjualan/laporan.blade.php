@extends('layout.master')

@section('title', 'Riwayat Pembelian')

@section('content')
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Laporan Penjualan</h2>
            <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('penjualan') }}">Data Penjualan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Penjualan</li>
                  </ol>
                </nav>
            </div>
            
            <div class="col-md-12 mt-1">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <table class="table table-hover text-center mt-2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cetak_pertanggal as $cetak)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ date('d M Y', strtotime($cetak->pesanan->tanggal_pesanan)) }}</td>
                                  <td>{{ $cetak->barang->nama_barang }}</td>
                                  <td>{{ $cetak->jumlah_barang }}</td>
                                  <td>Rp. {{ number_format($cetak->jumlah_harga_barang) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total Penjualan :</strong></td>
                                    <td><strong>{{ number_format($cetak->filter_total_barang($tanggal_awal, $tanggal_akhir)) }}</strong></td>
                                    <td><strong>Rp. {{ number_format($cetak->filter_total($tanggal_awal, $tanggal_akhir)) }}</strong></td>
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
