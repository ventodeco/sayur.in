@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="col">
            <div class="row mb-5">
                <h1>Invoice Pesanan</h1>
            </div>
            
        </div>
        <div class="card-block mb-3">
            <div class="card p-4 col-sm-6">
                <div class="col">
                    <pre>Invoice Number : {{ $order->invoice_number }}</pre>
                    <pre>Harga          : Rp{{ $order->amount }},00</pre>
                    <pre>Status         : {{ $order->status_pembayaran }}</pre>
                    <pre>Nama Penerima  : {{ $order->nama_penerima }}</pre>
                    <pre>Alamat         : {{ $order->alamat }}, {{ $order->kota }}</pre>
                    <pre>Notes          : {{ $order->notes }}</pre>
                    <pre>Detail Pesanan : </pre>
                    @foreach ($order->order_detail as $item)
                        <img src="{{asset($item->path)}}" width="100" height="100" alt=""><br>
                        <pre> Resep {{ $item->name }} sebanyak {{ $item->jumlah }}</pre>
                    @endforeach
                    @if ($order->status == 'unpaid')
                        <form action="{{ route('bayar', $order->id) }}" method="get">
                            <button type="submit" class="btn btn-outline">Bayar Sekarang</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

  @endsection