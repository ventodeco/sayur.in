@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="col">
            <div class="row mb-5">
                <h1>Keranjang Anda</h1>
            </div>
        </div>
        @if (count($reseps))
            @foreach ($reseps as $resep)
            <div class="card-block mb-3">
                <div class="card">
                    <div class="d-flex flex-lg-row flex-column align-items-center">
                        <div class="me-lg-3">
                        <img
                            src="{{ asset($resep->image) }}"
                            alt="" 
                            height="200"
                            />
                        </div>
                        <div class="flex-grow-1 text-lg-start text-center card-text">
                        <h3 class="card-title">
                            {{ $resep->name }}
                        </h3>
                        <p class="card-caption">
                            Rp.{{ $resep->harga }},00
                        </p>
                        <label for="jumlah">Jumlah Pesan</label>
                        <form method="post" action="{{ route('change-value') }}" id="myForm-{{$resep->id}}">
                            @csrf
                            <input id="value-{{$resep->id}}" type="number" onchange="submit({{$resep->id}})" name="jumlah" value="{{$resep->resep_value ?? 1}}" min="1" required>
                            <input type="text" name="map_id" value="{{ $resep->keranjang_map_id }}" hidden>
                        </form>
                        </div>
                        <div class="card-btn-space">
                        <form action="{{ route('delete-keranjang', $resep->id) }}">
                            <button type="submit" class="btn btn-outline">Hapus Pesanan</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Total Harga Pesanan Rp.{{ $totalHarga }},00</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <a href="{{ route('checkout') }}" class="btn btn-fill text-white">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col mt-5">
                <p>Keranjang Anda Kosong, Mari Berbelanja</p>
            </div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

    <script>
            function submit(id) {
                $("#myForm-" + id).submit();
            };
    </script>
  @endsection