@extends('layout.master')

@section('title', 'Riwayat Pembelian')

@section('content')
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Riwayat Pembelian</h2>
            <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Pembelian</li>
                  </ol>
                </nav>
            </div>
            
            <div class="col-md-12 mt-1">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Status Pembelian</th>
                                    <th>Total Pembelian</th>
                                    <th>Pembayaran</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesanan as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($p->tanggal_pesanan)) }}</td>
                                    <td>
                                        @if($p->status_pesanan == "pesan")
                                            <span class="badge bg-warning">Pesan</span>
                                        @elseif($p->status_pesanan == "Belum Diverifikasi")
                                            <span class="badge bg-danger">Belum Diverifikasi</span>
                                        @else
                                            <span class="badge bg-success">Sudah Diverifikasi</span>
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($p->jumlah_harga) }}</td>
                                    <td>
                                        @if($p->status_pesanan == "pesan")
                                        <a href="{{ url('pembayaran') }}/{{ $p->id }}">Bayar Sekarang</a>
                                        @elseif($p->status_pesanan == "Belum Diverifikasi")
                                        <a href="{{ url('pembayaran') }}/{{ $p->id }}">Lihat Pembayaran</a>
                                        @else
                                        Sudah bayar dan terverifikasi
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('riwayat') }}/{{$p->id}}" class="btn btn-primary"><i class="fa fa-info" title="Info Detail Pembelian"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block col-md-12 mt-2">
          {{ $pesanan->links() }}
        </div>
    </div>
</section>
@endsection
