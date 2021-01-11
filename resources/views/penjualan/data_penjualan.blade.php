@extends('layout.master')

@section('title', 'Riwayat Pembelian')

@section('content')
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Data Penjualan</h2>
            <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Penjualan</li>
                  </ol>
                </nav>
            </div>

            <!-- new -->

            <?php
                    $pesanan = \App\Pesanan::count();
                    
                ?>

            @if(!empty($pesanan))
            <div class="col-md-4 mt-2">
                <div class="card text-white bg-info mb-3 shadow-lg p-3">
                  <div class="card-body">
                    <div class="row text-center">
                        <h5 class="card-title col-md-7">Jumlah Penjualan</h5>
                        <h1 class="col-md-5">{{ $pesanan }}</h1>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="card text-white bg-success mb-3 shadow-lg p-3">
                  <div class="card-body">
                    <div class="row text-center">
                        <h5 class="card-title col-md-7">Jumlah Barang Terjual</h5>
                        @foreach($pesanan_detail as $p)
                        @endforeach
                        <h1 class="col-md-5">{{ $p->barang_terjual() }}</h1>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="card text-white bg-danger mb-3 shadow-lg p-3">
                  <div class="card-body">
                    <div class="row text-center">
                        <h6 class="card-title col-md-5">Total Penjualan</h6>
                        @foreach($pesanan_detail as $p)
                        @endforeach
                        <h5 class="col-md-7">Rp. {{ number_format($p->total_penjualan()) }}</h5>
                    </div>
                  </div>
                </div>
            </div>
            
            <!-- new -->

            <div class="col-md-12">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-filter"></i> Filter Tanggal</a>
                        <table class="table table-hover text-center mt-2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga</th>
                                    <th>Status Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesanan_detail as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($p->pesanan->tanggal_pesanan)) }}</td>
                                    <td>{{ $p->barang->nama_barang }}</td>
                                    <td>{{ $p->jumlah_barang }}</td>
                                    <td>Rp. {{ number_format($p->jumlah_harga_barang) }}</td>
                                    @if($p->pesanan->status_pesanan == "pesan")
                                    <td>Belum Bayar</td>
                                    @elseif($p->pesanan->status_pesanan == "proses")
                                    <td>Keep barang</td>
                                    @elseif($p->pesanan->status_pesanan == "Belum Diverifikasi")
                                    <td>Belum Diverifikasi</td>
                                    @elseif($p->pesanan->status_pesanan == "Terverifikasi")
                                    <td>Terverifikasi</td>
                                    @endif
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total Penjualan :</strong></td>
                                    <td><strong>{{ number_format($p->barang_terjual()) }}</strong></td>
                                    <td><strong>Rp. {{ number_format($p->total_penjualan()) }}</strong></td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>


    </div>
</section>

<!-- modal filter -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Masukkan Tanggal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/penjualan/laporan') }}" method="get">
          @csrf
          <div class="form-group">
            <label for="tanggal_awal">Tanggal Awal</label>
            <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required="">
          </div>
          <div class="form-group">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required="">
          </div>

          <div class="modal-footer">
             <a onclick="this.href='{{ url('/cetak-data-pertanggal') }}'+ '/' +document.getElementById('tanggal_awal').value + '/' + document.getElementById('tanggal_akhir').value" class="btn btn-primary col-md-12">Lihat Riwayat Keuangan 
           </a>
           <!-- <a href="" class="btn btn-info col-md-12">Lihat Riwayat Keuangan</a> -->
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
