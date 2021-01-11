@extends('layout.master')

@section('title', 'Tambah Barang')

@section('content')
 <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tambah Barang</h2>
                    <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
                          </ol>
                        </nav>
                    </div>
                    <div class="col-md-12 mt-1" id="tengah">
                        <div class="card shadow p-3 mb-5 bg-white rounded ">
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-12">                                        
                                        <form action="{{ url('/barang/tambah') }}" method="post" enctype="multipart/form-data" >
                                        @csrf
                                         
                                          <div class="form-group row {{$errors->has('nama_barang') ? 'has-error' : ''}}">
                                            <label for="nama_barang" class="col-md-2 col-form-label">Nama Barang</label>
                                            <div class="col-md-10">
                                              <input name ="nama_barang" type="text" class="form-control" id="nama_barang" value="{{ old('nama_barang') }}" required="">
                                              @if($errors->has('nama_barang'))
                                                  <span class="form-text text-danger">{{$errors->first('nama_barang')}}</span>
                                              @endif
                                            </div>
                                          </div>
                                          <div class="form-group row {{$errors->has('harga_barang') ? 'has-error' : ''}}">
                                            <label for="harga_barang" class="col-md-2 col-form-label">Harga Barang</label>
                                            <div class="col-md-10">
                                              <input name="harga_barang" type="number" min="0" class="form-control" id="harga_barang" value="{{ old('harga_barang') }}" required="">
                                              @if($errors->has('harga_barang'))
                                                  <span class="form-text text-danger">{{$errors->first('harga_barang')}}</span>
                                              @endif
                                            </div>
                                          </div>
                                          <div class="form-group row {{$errors->has('stok_barang') ? 'has-error' : ''}}">
                                            <label for="stok_barang" class="col-md-2 col-form-label">Stok Barang</label>
                                            <div class="col-md-10">
                                              <input name="stok_barang" type="number" class="form-control" id="stok_barang" min="0" value="{{ old('stok_barang') }}" required="">
                                              @if($errors->has('stok_barang'))
                                                  <span class="form-text text-danger">{{$errors->first('stok_barang')}}</span>
                                              @endif
                                            </div>
                                          </div>
                                          <div class="form-group row {{$errors->has('keterangan') ? 'has-error' : ''}}">
                                            <label for="keterangan" class="col-md-2 col-form-label">Keterangan</label>
                                            <div class="col-md-10">
                                              <textarea name="keterangan" class="form-control" id="keterangan" required="">{{ old('keterangan') }}</textarea>
                                              @if($errors->has('keterangan'))
                                                  <span class="form-text text-danger">{{$errors->first('keterangan')}}</span>
                                              @endif
                                            </div>
                                          </div>
                                          <div class="form-group row {{$errors->has('gambar') ? 'has-error' : ''}}">
                                              <label for="gambar" class="col-md-2 col-form-label">Upload Gambar</label>
                                              <div class="col-md-10">
                                                <input type="file" class="form-control-file" name="gambar" id="gambar" value="{{ old('gambar') }}" required="">
                                                @if($errors->has('gambar'))
                                                    <span class="form-text text-danger">{{$errors->first('gambar')}}</span>
                                                @endif
                                              </div>
                                          </div>
                                          <button type="submit" class="btn btn-primary">SIMPAN</button>
                                          <a href="{{ url('home') }}" class="btn btn-outline-primary">Kembali</a>
                                        </form>

                                    </div>
                                </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </section>
@endsection