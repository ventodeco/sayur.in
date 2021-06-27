@extends('admin.templates.default')

@section('content')
	<h1>Pesanan Update</h1>

    <form  action="{{ route('form-submit-pesanan') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="">Invoice Number : {{ $pesanan->invoice_number }}</label>
        </div>
        <div class="form-group">
            <label for="">Jumlah Bayar : {{ $pesanan->amount }}</label>
        </div>
        <div class="form-group">
            <label for="">Nama Penerima : {{ $pesanan->nama_penerima }}</label>
        </div>
        <div class="form-group">
            <label for="">Alamat : {{ $pesanan->alamat }}</label>
        </div>
        <div class="form-group">
            <label for="">Kota : {{ $pesanan->kota }}</label>
        </div>
        <div class="form-group">
            <label for="">Notes : {{ $pesanan->notes }}</label>
        </div>

        <div class="form-group">
            <label for="">Order Status</label>
            <select name="order_status" id="">
                <option @if ($pesanan->order_status == 'processing') selected @endif value="processing">Masih Diproses</option>
                <option @if ($pesanan->order_status == 'finish') selected @endif value="finish">Sudah Dikirim</option>
            </select>
        </div>
        <input type="text" name="pesanan_id" value="{{$pesanan->id}}" hidden>

        <button type="submit" class="btn btn-success">Update Pesanan</button>
    </form>
@endsection