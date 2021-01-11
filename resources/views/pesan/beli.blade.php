@extends('layout.master')

@section('title', 'Pembelian')

@section('content')
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Pembelian Barang</h2>
            <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembelian</li>
                  </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        @if(!empty($pesanan))
                        @if($pesanan->jumlah_harga == 0)
                        @else
                        <a href="{{ url('bayar') }}" class="btn btn-danger mb-2" onclick="return confirm('Setelah Anda Membayar, Anda Tidak Bisa Membatalkan Pesanan');">
                            Bayar Sekarang
                        </a>
                        @endif
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Barang (pcs)</th>
                                    <th>Total Harga Barang</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesanan_details as $pesanan_detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pesanan_detail->barang->nama_barang }}</td>
                                    <td>{{ $pesanan_detail->jumlah_barang }}</td>
                                    <td>Rp. {{ number_format($pesanan_detail->barang->harga_barang ) }}</td>
                                    <td>Rp. {{ number_format($pesanan_detail->jumlah_harga_barang) }}</td>
                                    <td>
                                        <form action="{{ url('hapus') }}/{{ $pesanan_detail->id }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus barang ini ?');">
                                                <i class="fa fa-trash" title="Hapus Barang"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right"><strong>Total :</strong></td>
                                    <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                                    <td>
                                        
                                    </td>
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
