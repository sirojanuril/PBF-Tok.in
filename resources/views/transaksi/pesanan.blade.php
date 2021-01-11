@extends('layout.master')

@section('title', 'Riwayat Pemesanan')

@section('content')
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Riwayat Pesanan</h2>
            <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    @if(auth()->user()->level == 'admin')
                    <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                    @else
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Pembelian</li>
                    @endif
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
                                    <th>Tanggal</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Status</th>
                                    <th>Pesanan</th>
                                    <th>Pembeli</th>
                                    <th>Detail Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksi as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($t->created_at)) }}</td>
                                    <td width="20%">
                                        @if(!empty($t->bukti_pembayaran))
                                        <a data-lightbox="image-1" href="{{ asset('storage/pembayaran/'.$t->bukti_pembayaran) }}">
                                            <img class="img-fluid rounded" src="{{ asset('storage/pembayaran/'.$t->bukti_pembayaran) }}" alt="" width="10%" />
                                        @else
                                            <b>-</b>
                                        @endif
                                        </a>
                                    </td>
                                    <td>
                                        @if($t->pesanan->status_pesanan == "pesan")
                                        <span class="badge bg-danger">Belum Diverifikasi</span>
                                        @elseif($t->pesanan->status_pesanan == "Belum Diverifikasi")
                                        <span class="badge bg-danger">Belum Diverifikasi</span>
                                        @elseif($t->pesanan->status_pesanan == "Terverifikasi")
                                        <span class="badge bg-success">Terverifikasi</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if($t->pesanan->status_pesanan == "pesan")
                                        <a href="#portfolioModal-{{ $t->id }}" data-toggle="modal">Verifikasi</a>
                                        @elseif($t->pesanan->status_pesanan == "Belum Diverifikasi")
                                        <a href="#portfolioModal-{{ $t->id }}" data-toggle="modal">Verifikasi</a>
                                        @elseif($t->pesanan->status_pesanan == "Terverifikasi")
                                        <a href="#portfolioModal-{{ $t->id }}" data-toggle="modal">Sudah Diverifikasi</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('detail-pembeli') }}/{{$t->pesanan->user->id}}">Info Pembeli</a>
                                    </td>
                                    
                                    <td>
                                        <a href="{{ url('riwayat') }}/{{$t->id}}" class="btn btn-primary"><i class="fa fa-info" title="Info Detail Pembelian"></i></a>
                                        
                                        
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
          {{ $transaksi->links() }}
        </div>
    </div>
</section>

@foreach($transaksi as $transaksis)
<div class="portfolio-modal modal fade" id="portfolioModal-{{ $transaksis->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal"><img src="{{('assets/img/close-icon.svg')}}" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project Details Go Here-->
                            <h4 class="text-uppercase">Verifikasi Pesanan</h4>

                            <form action="{{ url('konfirmasi') }}/{{ $transaksis->pesanan->id }}" method="POST">
                                @csrf
                                
                                <!-- <label for="status_pesanan" class="col-form-label">Verifikasi Pesanan</label> -->
                                <div class="form-group row mt-3">
                                    <label for="status_pesanan" class="col-md-2 col-form-label"></label>
                                    <div class="col-md-8">
                                        @if($transaksis->pesanan->status_pesanan == "Terverifikasi")
                                        <span style="color: red;">Sudah Diverifikasi</span>
                                        @else
                                        <select class="form-control @error('status_pesanan') is-invalid @enderror" name="status_pesanan" required="" autofocus="">
                                            <option value="{{ $transaksis->pesanan->status_pesanan }}">-- Verifikasi Pesanan --</option>
                                            <option value="Terverifikasi"{{(old('status_pesanan') == 'Terverifikasi') ? ' selected' : ''}}>Terverifikasi</option>
                                            <option value="pesan"{{(old('status_pesanan') == 'pesan') ? ' selected' : ''}}>Belum Diverifikasi</option>
                                        </select>
                                        @error('status_pesanan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @endif
                                    </div>
                                </div>

                                <img class="img-fluid d-block mx-auto rounded " src="{{ asset('storage/pembayaran/'.$transaksis->bukti_pembayaran) }}" width="30%" alt="" />
                                @if($transaksis->pesanan->status_pesanan == "Terverifikasi")
                                @else
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                                @endif
                            </form>
                            
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
