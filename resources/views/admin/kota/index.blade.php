@extends('admin.templates.default')

@section('content')
	<div class="container">
    <div class="row">
      <h1>Data kota</h1>

      <a href="{{ route('create-kota') }}" class="btn btn-success">Tambah kota</a>
    </div>

    <div class="row">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Nama kota</th>
            <th>Harga</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($kotas as $kota)
            <tr>
              <td>{{$kota->name ?? '-'}}</td>
              <td>{{$kota->harga}}</td>
              <td>
                <a href="{{ route('edit-kota', $kota->id) }}" class="btn btn-success">Edit</a>
                <a href="{{ route('delete-kota', $kota->id) }}" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection