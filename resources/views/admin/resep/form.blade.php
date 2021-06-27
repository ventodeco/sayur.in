@extends('admin.templates.default')

@section('content')
	<h1>@if($resep) Edit Resep @else Tambah Resep @endif</h1>

    <form  action="{{ route('form-submit-resep') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="">Nama Resep</label>
          <input type="text" name="name" value="{{ $resep->name ?? '' }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="">Deskripsi</label>
            <input type="text" value="{{ $resep->deskripsi ?? '' }}" name="deskripsi" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="">Porsi</label>
            <input type="number" value="{{ $resep->porsi ?? 1 }}" min="1" name="porsi" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="">Harga</label>
            <input type="number" value="{{ $resep->harga ?? 0 }}" min="1" name="harga" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="">Bahan</label>
            <input type="text" name="bahan" value="{{ $resep->bahan ?? '' }}" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="">Prosedur</label>
          <textarea class="form-control" name="prosedur" required>{{ $resep->prosedur ?? null }}</textarea>
        </div>

        <div class="form-group">
            <label for="">Stock</label>
            <input type="text" name="stock" value="{{ $resep->stock ?? '' }}" class="form-control" required>
        </div>
        @if ($resep)
            <input type="text" name="resep_id" value="{{$resep->id}}" hidden>
        @endif

        <button type="submit" class="btn btn-success">@if($resep) Update Resep @else Tambah Resep @endif</button>
    </form>
@endsection