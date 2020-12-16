<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <title>Login Template</title> -->
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::to('css/login.css') }}">
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 login-section-wrapper">
                    <div class="card col d-flex justify-content-center">
                        <!-- <div class="card-header">{{ __('Login') }}</div> -->
                        <div class="login-wrapper my-auto mx-auto">
                            <h5 class="d-flex justify-content-center">REGISTER</h5>
                            <h1 class="d-flex justify-content-center login-title">YOUR IPB MAPS</h1>

                            <!-- FORM LOGIN -->
                            <form class="mx-auto" method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- USERNAME -->
                                <div class="form-group">
                                    <label for="email">Nama</label>
                                    <input id="name" type="text" class="form-control form-rounded @error('name') is-invalid @enderror" placeholder="Nama / Username" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- EMAIL -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-rounded @error('email') is-invalid @enderror" placeholder="ID Pengguna" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- PASSWORD -->
                                <div class="form-group mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-rounded" placeholder="Kata Sandi" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group mb-4">
                                    <label for="password-confirm">Confirm Password</label>

                                    <div class="">
                                        <input id="password-confirm" type="password" class="form-control form-rounded" placeholder="Konfirmasi Kata Sandi" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>



                                <!-- <input name="login" id="login" class="btn btn-block login-btn" type="button" value="LOGIN"> -->
                                <div>
                                    <div>
                                        <button type="submit" class="btn btn-block login-btn">
                                            {{ __('REGISTER') }}
                                        </button>
                                    </div>
                                </div>

                                <!-- LINE -->
                                <br>
                                <hr />

                                <!-- Route to Login -->
                                <div>
                                    <label class="d-flex justify-content-center" style="font-size: 16px; color: #1C7BD9;">Sudah Punya Akun?</label>
                                    <a class="btn btn-block login-btn" href="{{ route('login') }}">LOGIN</a>
                                </div>


                            </form>
                            <!-- <a href="#!" class="forgot-password-link">Forgot password?</a>
              <p class="login-wrapper-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a></p> -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="{{ URL::to('/assets/img/login3.png') }}" alt="login image" class="login-img">
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>