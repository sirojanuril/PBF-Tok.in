@extends('layout.master')

@section('title', 'Riwayat Pembelian')

@section('content')
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Bayar Pesanan</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('riwayat') }}">Riwayat Pembelian</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cek Pembayaran</li>
                  </ol>
                </nav>
            </div>
            <div class="col-md-5 mt-1">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <h5 class="text-center">Detail Pembayaran</h4>
                            <form method="POST" action="{{ url('bukti') }}/{{ $pesanan->id }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="jumlah_harga" class="col-md-4 col-form-label">Total Pembelian</label>
                                <div class="col-md-6">
                                    <p>Rp. {{ number_format($pesanan->jumlah_harga) }}</p>                        
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="status_pembayaran" class="col-md-4 col-form-label">Status Pembayaran</label>
                                <div class="col-md-6">
                                    @if(!empty($transaksi->status_pembayaran))
                                    <span class="badge bg-success">{{ $transaksi->status_pembayaran }}</span>
                                    @else
                                    <span class="badge bg-danger">Belum Bayar</span>
                                    @endif
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="bukti_pembayaran" class="col-md-4 col-form-label">Upload Bukti Pembayaran</label>
                                <div class="col-md-6">
                                    @if(empty($transaksi->bukti_pembayaran))
                                    <input id="bukti_pembayaran" type="file" class="form-control-file @error('bukti_pembayaran') is-invalid @enderror" name="bukti_pembayaran">

                                    @error('bukti_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @else
                                    <a data-lightbox="image-1" href="{{ asset('storage/pembayaran/'.$transaksi->bukti_pembayaran) }}">
                                        <img class="img-fluid rounded" src="{{ asset('storage/pembayaran/'.$transaksi->bukti_pembayaran) }}" alt="" />
                                    </a>
                                    
                                    @endif
                                </div>
                            </div>                            

                            @if(empty($transaksi->bukti_pembayaran))
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Upload
                                    </button>
                                </div>
                            </div>
                            @else
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mt-1">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded border-secondary mb-3">
                        <div class="card-body text-center">
                            <h5 class="text-center">Metode Pembayaran</h4>

                                <div class="col-md-12 mt-5">
                                    <img class="img-fluid" src="{{ url('img/bca.png') }}" alt="..">
                                    <p>No. Rekening : 123456789</p>                        
                                </div>
                                <div class="col-md-12 mt-2">
                                    <img class="img-fluid" src="{{ url('img/bni.jpg') }}" alt="..">
                                    <p>No. Rekening : 123456789</p>                        
                                </div>
                                <div class="col-md-12 mt-2">
                                    <img class="img-fluid" src="{{ url('img/bri.jpg') }}" alt="..">
                                    <p>No. Rekening : 123456789</p>                        
                                </div>
                                <div class="col-md-12 mt-2">
                                    <img class="img-fluid" src="{{ url('img/mandiri.png') }}" alt="..">
                                    <p>No. Rekening : 123456789</p>                        
                                </div>
                                
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
