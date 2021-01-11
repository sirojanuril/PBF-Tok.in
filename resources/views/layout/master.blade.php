<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.head')
        @yield('style')
    </head>
    <body id="page-top">
        <!-- Navigation-->
        @yield('nav')
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">TOK - in</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <?php
                    $pesanan = \App\Pesanan::where('user_id', Auth::user()->id)->where('status_pesanan', "proses")->first();

                    // $bayar = \App\Pesanan::where('user_id', Auth::user()->id)->where('status_pesanan', "pesan")->count();
                    
                    $bayar = \App\Pesanan::where('user_id', Auth::user()->id)->where('status_pesanan', "Belum Diverifikasi")->count();
                    // $bayar = \App\Pesanan::where('user_id', Auth::user()->id)->where('status_pesanan', '!=', "Terverifikasi")->Where('status_pesanan', '!=', "proses")->count();
                    $verifikasi = \App\Pesanan::where('status_pesanan', "Belum Diverifikasi")->count();

                    if (!empty($pesanan)) 
                    {
                        $belum_bayar         = \App\PesananDetail::where('pesanan_id', $pesanan->id)->count();
                    }
                    
                ?>

                

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger {{ Request::is('home')? "active":"" }}" href="{{ url('home') }}">Home</a></li>
                        @if(auth()->user()->level == 'admin')
                        <li class="nav-item"><a class="nav-link js-scroll-trigger {{ Request::is('barang')? "active":"" }}" href="{{ url('/barang') }}">Tambah Barang</a></li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger {{ Request::is('pesanan')? "active":"" }}" href="{{ url('/pesanan') }}">Pesanan
                                @if(!empty($verifikasi))
                                    <span class="badge badge-danger">{{ $verifikasi }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger {{ Request::is('penjualan')? "active":"" }}" href="{{ url('/penjualan') }}">Penjualan</a></li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger {{ Request::is('beli')? "active":"" }}" href="{{ url('/beli') }}">Pembelian
                                @if(!empty($belum_bayar))
                                    <span class="badge badge-danger">{{ $belum_bayar }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger {{ Request::is('riwayat')? "active":"" }}" href="{{ url('/riwayat') }}">Riwayat
                                @if(!empty($bayar))
                                    <span class="badge badge-danger">{{ $bayar }}</span>
                                @endif
                            </a>
                        </li>
                        @endif

                        
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(empty(auth()->user()->foto_akun))
                                <img src="{{ url('img/default.jpg') }}" style="width: 30px; height: 30px; border-radius: 50%;" alt="User" title="{{ Auth::user()->name }}">
                                <span class="caret"></span>
                                @else
                                <img src="{{ asset('storage/profil/'.auth()->user()->foto_akun) }}" style="width: 30px; height: 30px; border-radius: 50%;" alt="User" title="{{ Auth::user()->name }}">
                                <span class="caret"></span>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('akun') }}">
                                    Akun
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
                                    

        <!-- Portfolio Grid-->
        @include('layout.alert')

        @yield('content')

        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Hubungi Kami</h2>
                    <h3 class="section-subheading text-muted">TOK - in -- Toko Perlengkapan Laptop</h3>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-5 text-lg-left"></div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-primary btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="text-center">
                    <h6>Copyright © Kelompok4 PBF-B 2020</h6>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->

        @include('layout.script')
    </body>
</html>
