<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <section class="section">
          <div class="container">
            <div class="row">
              <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">
                  <img src="{{ asset('assets/img/logo/logo.png') }}" alt="logo" width="100">
                </div>
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>Register</h4>
                  </div>

                  <div class="card-body">
                    <form method="POST" action="{{ route('admin.store') }}">
                      @csrf
                      <div class="form-group">
                        <label for="name">Nama</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autofocus>
                        @error('name')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                        @error('email')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="password" class="d-block">Password</label>
                        <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror"
                          data-indicator="pwindicator" name="password">
                        <div id="pwindicator" class="pwindicator">
                          <div class="bar"></div>
                          <div class="label"></div>
                        </div>
                        @error('password')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="form-group test">
                        <label for="role">Role</label>
                        <select class="form-control selectric @error('role') is-invalid @enderror" name="role" id="role">
                          <option hidden value="">Pilih Role</option>
                          <option value="admin_divisi">Admin Divisi</option>
                          <option value="kepala_divisi">Kepala Divisi</option>
                          <option value="mutu">Mutu</option>
                          <option value="administrasi_umum">Administrasi Umum</option>
                          <option value="kepala_lpfk">Kepala LPFK</option>
                          <option value="ppk">PPK</option>
                          <option value="superadmin">Superadmin</option>
                        </select>
                      </div>

                      <div class="form-group division d-none">
                        <label for="division">Divisi</label>
                        <select class="form-control selectric @error('division_id') is-invalid @enderror" name="division_id" id="division">
                          <option hidden value="">Pilih Divisi</option>
                          @foreach ($divisions as $divisi)
                            <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                          @endforeach
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
      </div>
    </div>
  </div>
</div>
