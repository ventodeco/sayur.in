@extends('admin.templates.default')

@section('content')
	<h1>@if($kota) Edit kota @else Tambah kota @endif</h1>

    <form  action="{{ route('form-submit-kota') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="">Nama Kota</label>
          <input type="text" name="name" value="{{ $kota->name ?? '' }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="">Harga</label>
            <input type="text" value="{{ $kota->harga ?? '' }}" name="harga" class="form-control" required>
        </div>
        @if ($kota)
            <input type="text" name="kota_id" value="{{$kota->id}}" hidden>
        @endif

        <button type="submit" class="btn btn-success">@if($kota) Update kota @else Tambah kota @endif</button>
    </form>
@endsection