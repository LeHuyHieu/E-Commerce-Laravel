<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('backend/assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">
    <title>Rukada - Responsive Bootstrap 5 Admin Template</title>
</head>

<body class="bg-login">
<!--wrapper-->
<div class="wrapper">
    <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col mx-auto">
                    <div class="my-4 text-center">
                        <img src="{{ asset('backend/assets/images/logo-img.png') }}" width="180" alt="" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Sign Up</h3>
                                    <p>Already have an account? <a href="{{ route('admin.sign_in') }}">Sign in here</a>
                                    </p>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="col-sm-12">
                                            <label for="inputFirstName" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" id="inputFirstName" placeholder="customer" :value="old('username')" required autofocus autocomplete="off" >
                                        </div>
                                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                        <div class="col-sm-12">
                                            <label for="inputLastName" class="form-label">Full name</label>
                                            <input type="text" name="name" class="form-control" id="inputLastName" placeholder="Deo" :value="old('name')" required autocomplete="off">
                                        </div>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="example@user.com" :value="old('email')" required autocomplete="off">
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password" required autocomplete="new-password" /> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <div class="input-group" id="show_hide_confirm_password">
                                                <input type="password" name="password_confirmation" class="form-control border-end-0" id="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password"  /> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="role" value="vendor" id="vendorRadio">
                                                <label class="form-check-label" for="vendorRadio">Vendor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="role" value="customer" checked id="customerRadio">
                                                <label class="form-check-label" for="customerRadio">Customer</label>
                                            </div>
                                        </div>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
        $("#show_hide_confirm_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_confirm_password input').attr("type") == "text") {
                $('#show_hide_confirm_password input').attr('type', 'password');
                $('#show_hide_confirm_password i').addClass("bx-hide");
                $('#show_hide_confirm_password i').removeClass("bx-show");
            } else if ($('#show_hide_confirm_password input').attr("type") == "password") {
                $('#show_hide_confirm_password input').attr('type', 'text');
                $('#show_hide_confirm_password i').removeClass("bx-hide");
                $('#show_hide_confirm_password i').addClass("bx-show");
            }
        });
    });
</script>
<!--app JS-->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>
</body>

</html>