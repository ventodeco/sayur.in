@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="col">
            <div class="row text-center">
                <h1>{{ $resep->name }}</h1>
            </div>
            <div class="row text-center">
                <div class="col">
                    <img src="{{ asset($resep->image) }}" width="500" alt="">
                </div>
            </div>
            <div class="row mt-5">
                @php
                    $bahans = explode(',', $resep->bahan)
                @endphp
                <div class="col">
                    <h3>Bahan : </h3>
                    <ul>
                        @if ($bahans)
                            @foreach ($bahans as $bahan)
                                <li>{{ $bahan }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <div class="row mt-5">
                <h3>Tahap Pembuatan : </h3>
                <p>{{ $resep->prosedur }}</p>
            </div>

            <div class="row mt-5">
                <p>Stok Bahan Tersedia : {{ $resep->stock }}</p>
                <p>Harga : Rp.{{ $resep->harga }},00</p>
                <p>Porsi 1 Resep untuk {{ $resep->porsi }} orang</p>
            </div>
            @auth
                <div class="row">
                    <a href="{{ route('fill-keranjang', $resep->id) }}" 
                        class="btn btn-fill text-white"
                    >Masukkan Keranjang</a>
                </div>
            @endauth
        </div>
    </div>
  @endsection