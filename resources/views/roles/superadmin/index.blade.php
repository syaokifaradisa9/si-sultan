@extends('layouts.main')

@section('container')
<div class="section-body">
  @if (session()->has('success'))
  <div id="success" data-flash="{{ session('success') }}"></div>
  @endif
  <div class="card">
    <div class="card-header">
      <h4>Data User</h4>
      <div class="ml-auto">
        <a href="/admin/register" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add New User</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-md">
          <tr class="text-center">
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
          @foreach ($users as $data)
            <tr class="text-center">
              <td class="align-middle">{{ $loop->iteration }}</td>
              <td class="align-middle">{{ $data->name }}</td>
              <td class="align-middle">{{ $data->email }}</td>
              <td class="align-middle"> <a href="delete/{{ $data->id }}" class="btn btn-danger btn-delete" id="btn-confirm">
                <i class="fas fa-trash"></i></a></td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
<div class="section-body">
  <div class="card">
    <div class="card-header">
      <h4>Data User Bagian</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-md">
          <tr class="text-center">
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Divisi</th>
            <th>Aksi</th>
          </tr>
          @foreach ($user_divisions as $data)
          
            <tr class="text-center">
              <td class="align-middle">{{ $loop->iteration }}</td>
              <td class="align-middle">{{ $data->name }}</td>
              <td class="align-middle">{{ $data->email }}</td>
              <td class="align-middle">{{ $data->division->nama }}</td>
              <td class="align-middle"><a href="deleteDiv/{{ $data->id }}" class="btn btn-danger btn-delete" id="btn-confirm">
                <i class="fas fa-trash"></i></a></td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js-extends')
  <script src="{{ asset('assets/js/btn-function-delete.js') }}"></script>
@endpush
