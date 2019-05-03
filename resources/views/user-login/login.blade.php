<!DOCTYPE html>
<html>
    @include('user-login.layouts.header')
    <body>
        <div class="container-fluid px-3">
            <div class="row min-vh-100">
                <div class="col-md-5 col-lg-6 col-xl-4 px-lg-5 d-flex align-items-center">
                    <div class="w-100 py-5">
                        <div class="text-center"><img src="{{ asset('images/admin-img/robert.png') }}" alt="..." style="width:515px; height: 250px;" class="img-fluid">
                            <h1 class="display-4 mb-3">Admin Login</h1>
                        </div>
                        @if ($error = Session::get('failed'))
                            <div class="alert alert-warning">
                                {{ $error }}
                            </div>
                        @endif
                        <form class="form-validate" action="/user-login" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Email Address</label>
                                <input name="admin_email" value="{{ old('admin_email') }}" type="email" autocomplete="off" required data-msg="Please enter your email" class="form-control" autofocus>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <label>Password</label>
                                    </div>
                                </div>
                                <input name="admin_password" type="password" required data-msg="Please enter your password" class="form-control">
                            </div>
                            <button class="btn btn-lg btn-block btn-primary mb-3">Sign in</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">
                    <div>
                        <img src="{{ asset('images/admin-img/default-background.jpg') }}" style="width:1220px; height:980px;" alt="background-image">
                    </div>
                </div>
            </div>
        </div>
        @include('user-login.layouts.scripts')
    </body>
</html>
