@extends('layout.master')

@section('title', 'Home')

@section('content')
 <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    @if(auth()->user()->level == 'admin')
                    <h2 class="section-heading text-uppercase">Daftar Barang</h2>
                    <h3 class="section-subheading text-muted">Kelola barang dagangan</h3>
                    @else
                    <h2 class="section-heading text-uppercase">Belanja Barang</h2>
                    <h3 class="section-subheading text-muted">Silahkan pilih barang yang anda suka</h3>
                    @endif
                </div>
                <div class="row">
                    @if(auth()->user()->level == 'admin')
                        @foreach($barang as $barangs)
                        <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item shadow-sm p-3 mb-5 bg-white rounded">
                                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal-{{ $barangs->id}}">
                                        <div class="portfolio-hover">
                                            <div class="portfolio-hover-content"><i class="fas fa-info fa-3x"></i></div>
                                        </div>
                                        <img class="img-fluid" src="{{ asset('storage/thumbnail/'.$barangs->gambar) }}" alt="" />
                                    </a>
                                    <div class="portfolio-caption">
                                        <div class="portfolio-caption-heading">{{ $barangs->nama_barang }}</div>
                                        <div class="portfolio-caption-subheading text-muted">Harga : Rp. {{ number_format($barangs->harga_barang) }}</div>
                                        @if($barangs->stok_barang == 0)
                                        <div class="portfolio-caption-subheading text-muted">Stok : <b style="color: red;">Habis</b></div>
                                        @else
                                        <div class="portfolio-caption-subheading text-muted">Stok : {{ ($barangs->stok_barang) }}</div>
                                        @endif
                                        <p>{{ $barangs->keterangan }}</p>
                                        @if(auth()->user()->level == 'admin')
                                        <a href="{{ url('/barang/edit') }}/{{ $barangs->id }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ url('/barang/hapus') }}/{{ $barangs->id }}" class="btn btn-danger" onclick="return confirm('Anda akan menghapus barang ini ?')">Hapus</a>
                                        @else
                                        <a class="btn btn-primary" href="{{ url('/pesan') }}/{{ $barangs->id }}">Pesan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach($barang as $barangs)
                            @if($barangs->stok_barang == 0)
                            @else
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item shadow-sm p-3 mb-5 bg-white rounded">
                                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal-{{ $barangs->id}}">
                                        <div class="portfolio-hover">
                                            <div class="portfolio-hover-content"><i class="fas fa-info fa-3x"></i></div>
                                        </div>
                                        <img class="img-fluid" src="{{ asset('storage/thumbnail/'.$barangs->gambar) }}" alt="" />
                                    </a>
                                    <div class="portfolio-caption">
                                        <div class="portfolio-caption-heading">{{ $barangs->nama_barang }}</div>
                                        <div class="portfolio-caption-subheading text-muted">Harga : Rp. {{ number_format($barangs->harga_barang) }}</div>
                                        <div class="portfolio-caption-subheading text-muted">Stok : {{ ($barangs->stok_barang) }}</div>
                                        <p>{{ $barangs->keterangan }}</p>
                                        @if(auth()->user()->level == 'admin')
                                        <a href="{{ url('/barang/edit') }}/{{ $barangs->id }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ url('/barang/hapus') }}/{{ $barangs->id }}" class="btn btn-danger" onclick="return confirm('Anda akan menghapus barang ini ?')">Hapus</a>
                                        @else
                                        <a class="btn btn-primary" href="{{ url('/pesan') }}/{{ $barangs->id }}">Pesan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="d-block col-12">
                  {{ $barang->links() }}
                </div>
            </div>
        </section>

                <!-- Modal 1-->
        @foreach($barang as $b)
        <div class="portfolio-modal modal fade" id="portfolioModal-{{ $b->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="{{('assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">{{ $b->nama_barang }}</h2>
                                    <p class="item-intro text-muted"></p>
                                    <img class="img-fluid d-block mx-auto" src="{{ asset('storage/thumbnail/'.$b->gambar) }}" alt="" />
                                    <ul class="list-inline">
                                        <li>Harga : Rp. {{ number_format($b->harga_barang) }}</li>
                                        <li>Stok : {{ $b->stok_barang }}</li>
                                        <li>{{ $b->keterangan }}</li>
                                    </ul>
                                    @if(auth()->user()->level == 'admin')
                                    <a href="{{ url('/barang/edit') }}/{{ $b->id }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url('/barang/hapus') }}/{{ $b->id }}" class="btn btn-danger" onclick="return confirm('Anda akan menghapus barang ini ?')">Hapus</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
@stop
