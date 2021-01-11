@extends('landingpage.app')

@section('style')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">

@endsection

@section('content')
<section class="page-section">
    <div class="container">
        <div class="text-center">
            <!-- <h2 class="section-heading text-uppercase">{{ __('Login') }}</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
        </div>

          <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
            <div class="container">
              <div class="card login-card">
                <div class="row no-gutters">
                  <div class="col-md-5">
                    <img src="{{asset('assets/images/login-5.jpg')}}" alt="login" class="login-card-img">
                  </div>
                  <div class="col-md-7">
                    <div class="card-body">
                      <div class="brand-wrapper">
                        <h1>
                            <b>TOK - in</b>
                        </h1>
                        
                      </div>
                      <p class="login-card-description">Masuk ke akun anda</p>
                      <form method="POST" action="{{ route('login') }}">
                        @csrf
                          <div class="form-group">
                            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <div class="form-group mb-4">
                            <label for="password" class="sr-only">{{ __('Password') }}</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="***********" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="{{ __('Login') }}">
                            
                            <!-- <button type="submit" class="btn btn-primary">
                                
                            </button> -->
                        </form>
                        <small style="color: red;">Email admin : <b>admintoko@gmail.com</b></small> -
                        <small style="color: red;">Password admin : <b>admintoko</b></small>
                            
                        <!-- <a href="#!" class="forgot-password-link">Forgot password?</a> -->
                        <p class="login-card-footer-text mt-2">Belum punya akun ? <a href="{{ route('register') }}">Register Disini</a> untuk pembeli</p>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </main>
    </div>
</section>

<!-- Services-->
<!--         <section class="page-section">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">{{ __('Login') }}</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <div class="card">
                <center>
                    <img src="{{ url('assets/img/tok-in.png') }}" class="mt-2" style="width: 20%;">
                </center>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                       <!--  <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a href="{{ url('/') }}" class="btn btn-outline-primary">
                                    {{ __('Kembali') }}
                                </a> -->

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
  <!--                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section> -->

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
