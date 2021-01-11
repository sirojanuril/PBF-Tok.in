@extends('layout.master')

@section('title', 'Akun')

@section('content')
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Akun Pengguna</h2>
            <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>
        <div class="row">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Akun</li>
                  </ol>
                </nav>
            </div>
            <div class="col-md-4">
                    <div class="card shadow p-3 mb-5 bg-secondary text-white rounded ">
                        <div class="card-body">
                            <h4 class="text-center">Akun</h4>
                            <center>
                                @if(empty($user->foto_akun))
                                <img src="{{ url('img/default.jpg') }}" style="width: 150px; height: 150px; border-radius: 50%; border-style: groove;" alt="User" title="{{ Auth::user()->name }}">
                                @else
                                <img src="{{ asset('storage/profil/'.$user->foto_akun) }}" style="width: 150px; height: 150px; border-radius: 50%; border-style: groove;" alt="User" title="{{ Auth::user()->name }}">
                                @endif
                            </center>
                            
                            <table class="table table-hover mt-2 text-white">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td width="10">:</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>No HP</td>
                                        <td>:</td>
                                        <td>
                                            @if(!empty($user->no_hp))
                                            0{{ $user->no_hp }}
                                            @else
                                            <strong style="color: red;">Harus diisi sebelum membeli</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td>
                                            @if(!empty($user->jenis_kelamin))
                                            {{ $user->jenis_kelamin }}
                                            @else
                                            <strong style="color: red;">Harus diisi sebelum membeli</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>
                                            @if(!empty($user->tanggal_lahir))
                                            {{ date('d M Y', strtotime($user->tanggal_lahir)) }}
                                            @else
                                            <strong style="color: red;">Harus diisi sebelum membeli</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td> 
                                            @if(!empty($user->alamat))
                                            {{$user->alamat}} 
                                            @else
                                            <strong style="color: red;">Harus diisi sebelum membeli</strong>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody> 
                            </table>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <h4 class="text-center">Edit Akun</h4>
                            <form method="POST" action="{{ url('akun') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_hp" class="col-md-4 col-form-label">No HP</label>
                                    <div class="col-md-6">
                                        <input id="no_hp" type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="0{{ $user->no_hp }}" required autocomplete="no_hp">
                                        @error('no_hp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-md-4 col-form-label">Jenis Kelamin</label>
                                    <div class="col-md-6">
                                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required="">
                                            <option value="{{ $user->jenis_kelamin }}">-- Jenis Kelamin --</option>
                                            <option value="Pria"{{(old('jenis_kelamin') == 'Pria') ? ' selected' : ''}}>Pria</option>
                                            <option value="Wanita"{{(old('jenis_kelamin') == 'Wanita') ? ' selected' : ''}}>Wanita</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-md-4 col-form-label">Tanggal Lahir</label>
                                    <div class="col-md-6">
                                        <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" required value="{{ $user->tanggal_lahir }}">
                                        @error('tanggal_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                                    <div class="col-md-6">
                                        <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required ="" >{{ $user->alamat }}</textarea>
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="foto_akun" class="col-md-4 col-form-label">Foto Akun</label>
                                    <div class="col-md-6">
                                        <input id="foto_akun" type="file" class="form-control-file @error('foto_akun') is-invalid @enderror" name="foto_akun">
                                        <input type="hidden" class="form-control-file" id="hidden_gambar" name="hidden_gambar" value="{{ $user->foto_akun }}">
                                        @error('foto_akun')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection