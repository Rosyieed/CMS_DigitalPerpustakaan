<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | REN Digital Perpustakaan</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body style="background-color: #303030">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-black mb-2">Lupa Password</h6>
                        Silakan isi formulir di bawah ini dengan alamat email yang terkait dengan akun Anda, dan kami
                        akan mengirimkan tautan reset password.
                    </div>
                    <div class="card-body p-0">
                        <div class="d-none d-lg-block"></div>
                        <div class="p-3 mt-2">
                            <form class="user" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                @if (session('status'))
                                    <div class="alert alert-success mb-4" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-4" role="alert">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail"
                                        aria-describedby="emailHelp" placeholder="Masukan Alamat Email">
                                </div>
                                <button type="submit" class="btn btn-block text-white mb-2"
                                    style="background-color: #303030">Reset</button>
                            </form>
                            <hr>
                            <a class="small" href="/login">Sudah mendapatkan Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
