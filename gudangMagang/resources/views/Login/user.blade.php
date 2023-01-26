<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GO-DANG</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/login.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />
</head>

<body>
    <div class="container-fluid page-body-wrapper">
    <section class="forms-section">
        <h1 class="section-title">GO-DANG</h1>
        <div class="forms">
            <div class="form-wrapper is-active">
                <button type="button" class="switcher switcher-login">
                    Login
                    <span class="underline"></span>
                </button>
                <form action="/login" method="POST" class="form form-login">
                    @csrf
                    <fieldset>
                        <div class="input-block form-group">
                            <input class="form-control" type="username" id="username" name="username"required>
                            <label class="form-control-placeholder" for="username">Username</label>
                        </div>
                        <div class="input-block form-group">
                            <input class="form-control" type="password" id="password" name="password" required>
                            <label class="form-control-placeholder" for="password">Password</label>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
            <div class="form-wrapper">
                <button type="button" class="switcher switcher-signup">
                    Sign Up
                    <span class="underline"></span>
                </button>
                <form action="/registrasi" method="POST" class="form form-signup">
                    @csrf
                    <fieldset>
                        <div class="input-block form-group">
                            <input class="form-control" type="text" id="nama" name="nama" required>
                            <label class="form-control-placeholder" for="nama">Nama</label>
                        </div>
                        <div class="input-block form-group">
                            <input class="form-control" type="text" id="username" name="username" required>
                            <label class="form-control-placeholder" for="username">Username</label>
                        </div>
                        <div class="input-block form-group">
                            <input class="form-control" type="password" id="password" name="password" required>
                            <label class="form-control-placeholder" for="password">Password</label>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn-signup">Continue</button>
                </form>
            </div>
        </div>
    </section>
    </div>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/login.js') }}"></script>
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>
</body>

</html>
