@extends('admin.templates.default')

@section('content')
	<h1>Detail Pesanan</h1>

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
        <label for="">Status Pengiriman : {{ $pesanan->status_order }}</label>
    </div>

    <h3>Billing</h3>
    @php
        $billing = $pesanan->billing;
    @endphp
    <label for="">Bukti Pembayaran</label>
    <img src="{{asset('storage/' . $billing->path_bukti_transfer)}}" width="200" height="200"  alt="">
    <div class="form-group">
        <label for="">Nama dalam Rekening : {{ $billing->name }}</label>
    </div>
    <div class="form-group">
        <label for="">Nomor Rekening : {{ $billing->nomor_rekening }}</label>
    </div>
    <div class="form-group">
        <label for="">Nama Bank : {{ $billing->nama_bank }}</label>
    </div>
    <h3>Detail</h3>
    @foreach ($pesanan->order_detail as $item)
        <img src="{{asset($item->path)}}" width="100" height="100" alt=""><br>
        <pre> Resep {{ $item->name }} sebanyak {{ $item->jumlah }}</pre>
    @endforeach


@endsection