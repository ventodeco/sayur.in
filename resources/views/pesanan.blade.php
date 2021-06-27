@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="col">
            <div class="row mb-5">
                <h1>Pesanan Anda</h1>
            </div>
            
        </div>
        @if (count($orders))
            @foreach ($orders as $order)
            <div class="card-block mb-3">
                <div class="card p-4">
                    <div class="d-flex flex-lg-row flex-column align-items-center">
                        <div class="me-lg-3">
                        </div>
                        <div class="flex-grow-1 text-lg-start text-center card-text">
                        <h3>
                            {{ $order->invoice_number }}
                        </h3>
                        <label for="">Status Pembayaran : {{ $order->status_pembayaran }}</label>
                        <p class="card-caption">
                            
                        </p>
                        @if($order->status == 'paid')
                            <label for="">Status Pengiriman : {{ $order->status_order }}</label>
                        @endif
                        </div>
                        <div class="card-btn-space">
                        <form action="{{ route('detail-pesanan', $order->id) }}">
                            <button type="submit" class="btn btn-outline">Lihat Pesanan</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col mt-5">
                <p>Pesanan Anda Kosong, Segera Checkout Resep dengan Sayur Terpilih dan Resep terbaik disini</p>
            </div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

  @endsection