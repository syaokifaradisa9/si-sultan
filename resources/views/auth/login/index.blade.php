<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title ?? 'SI-SULTAN' }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css"
    integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/stisla/css/components.css') }}">
</head>
<div id="app">
  <section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
      <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
        <div class="p-4 m-3">
          <img src="{{ asset('vendor/stisla/img/stisla-fill.svg') }}" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
          <h4 class="text-dark font-weight-normal">Selamat Datang di Aplikasi <span class="font-weight-bold">Si-Sultan</span></h4>
          <p class="text-muted">Sebelum menggunakan aplikasi ini, silahkan login terlebih dahulu. Jika tidak mempunyai akun, silahkan hubungi tim
            admin
          </p>
          <form method="POST" action="{{ route('login.auth') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" required
                autofocus>
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
              <div class="d-block">
                <label for="password" class="control-label">Password</label>
              </div>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2"
                required>
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group text-right">
              <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                Login
              </button>
            </div>
          </form>

          @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible show fade">
              <div class="alert-body">
                <button class="close" data-dismiss="alert">
                  <span>&times;</span>
                </button>
                {{ session('error') }}
              </div>
            </div>
          @endif
        </div>
      </div>
      <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
        data-background="{{ asset('vendor/stisla/img/unsplash/login-bg.jpg') }}">
        <div class="absolute-bottom-left index-2">
          <div class="text-light p-5 pb-2">
            <div class="mb-5 pb-3">
              <h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
              <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
            </div>
            Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin
              Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- General JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('vendor/stisla/js/stisla.js') }}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{ asset('vendor/stisla/js/scripts.js') }}"></script>

<!-- Page Specific JS File -->
</body>

</html>
