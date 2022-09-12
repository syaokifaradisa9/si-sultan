@extends('layouts.main')

@section('container')
  <section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
          <div class="login-brand">
            <img src="{{ asset('vendor/stisla/img/stisla-fill.svg') }}" alt="logo" width="100"
              class="shadow-light rounded-circle">
          </div>
          <div class="card card-primary">
            <div class="card-header">
              <h4>Register</h4>
            </div>

            <div class="card-body">
              <form method="POST">
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input id="nama" type="text" class="form-control" name="nama" autofocus>
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email">
                  <div class="invalid-feedback">
                  </div>
                </div>

                <div class="form-group">
                  <label for="password" class="d-block">Password</label>
                  <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                    name="password">
                  <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control selectric">
                    <option>Admin Bagian</option>
                    <option>Kepala Bagian</option>
                    <option>Tata Operasional</option>
                    <option>Administrasi Umum</option>
                    <option>Kepala LPFK</option>
                    <option>PPK</option>
                  </select>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
