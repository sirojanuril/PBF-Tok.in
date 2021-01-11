@extends('landingpage.app')

@section('header')
<!-- Masthead-->
        <header class="masthead" style="background-image: url('assets/img/header-bg-4.jpg');">
            <div class="container">
                <div class="masthead-subheading">Selamat Datang di TOK - in!</div>
                <div class="masthead-heading text-uppercase">Pusat Penjualan Laptop</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Ketahui Lebih Banyak</a>
            </div>
        </header>

        <!-- <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Layanan Kami</h2>
                    <h3 class="section-subheading text-muted">Menjual laptop bermacam-macam jenis</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">E-Commerce</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Responsive Design</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Web Security</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                </div>
            </div>
        </section> -->

        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Layanan Kami</h2>
                    <h3 class="section-subheading text-muted">Menjual laptop bermacam-macam jenis</h3>
                </div>
                <div class="row text-center">
                    @foreach($barang as $barangs)
                    @if($barangs->stok_barang == 0)
                    @else
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal-{{ $barangs->id}}">
                                <img class="img-fluid" src="{{ asset('storage/thumbnail/'.$barangs->gambar) }}" alt="" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">{{ $barangs->nama_barang }}</div>
                                <div class="portfolio-caption-subheading text-muted">Harga : Rp. {{ number_format($barangs->harga_barang) }}</div>
                                <div class="portfolio-caption-subheading text-muted">Stok : {{ ($barangs->stok_barang) }}</div>
                                <p>{{ $barangs->keterangan }}</p>
                                <a class="btn btn-primary" href="{{ route('login') }}" onclick="return confirm('Anda harus LOGIN terlebih dahulu untuk membeli barang ini !!')">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </section>
        
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tentang Kami</h2>
                    <h3 class="section-subheading text-muted">Kelebihan berbelanja di Tok - in</h3>
                </div>
                <ul class="timeline">
                    
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{('assets/img/about/3.jpg')}}" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Pembelian Barang</h4>
                                <h4 class="subheading">Sangat Mudah</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Pembelian sangat mudah sekali, hanya dengan pilih barang yang anda suka dan ingin dibeli lalu klik pesan dan barang yang anda suka telah terbeli !!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{('assets/img/about/5.png')}}" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Barang</h4>
                                <h4 class="subheading">Sangat Lengkap</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Tersedia berbagai macam dan jenis-jenis laptop dan sangat lengkap, tentunya sangat berkualitas dengan harga terjangkau !!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Kuy
                                <br />
                                Belanja Di
                                <br />
                                TOK - in !!!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tim Kelompok 4</h2>
                    <h3 class="section-subheading text-muted">Project Mata Kuliah PBF</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{('assets/img/team/4.jpg')}}" alt="" />
                            <h4>Grace Sintia Girsang</h4>
                            <p class="text-muted">182410101039</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{('assets/img/team/5.jpg')}}" alt="" />
                            <h4>Indah Luwisari Tambunan</h4>
                            <p class="text-muted">182410101108</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{('assets/img/team/6.jpg')}}" alt="" />
                            <h4>Siroja Nuril Hidayah</h4>
                            <p class="text-muted">182410101121</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
@endsection