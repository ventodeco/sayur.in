@extends('admin.templates.default')

@section('content')
	<div class="container">
    <div class="row">
      <h1>Data Resep</h1>

      <a href="{{ route('create-resep') }}" class="btn btn-success">Tambah Resep</a>
    </div>

    <div class="row">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Nama Resep</th>
            <th>Porsi</th>
            <th>Harga</th>
            <th>Bahan</th>
            <th>Prosedur</th>
            <th>Stock</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($reseps as $resep)
            <tr>
              <td>{{$resep->name ?? '-'}}</td>
              <td>{{$resep->porsi}}</td>
              <td>{{$resep->harga}}</td>
              <td>{{$resep->bahan}}</td>
              <td>{{$resep->prosedur}}</td>
              <td>{{$resep->stock}}</td>
              <td>{{$resep->image ?? '-'}}</td>
              <td>
                <a href="{{ route('edit-resep', $resep->id) }}" class="btn btn-success">Edit</a>
                <a href="{{ route('delete-resep', $resep->id) }}" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection