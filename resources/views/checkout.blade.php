@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="col">
            <div class="row">
                

            <div class="col-sm-6">
              <h1 class="mb-5">Checkout Pesanan</h1>
              <div class="row">
                <form action="{{ route('create-order') }}" method="post">
                  @csrf
                    <div class="form-group mt-2">
                      <label for="exampleFormControlInput1">Nama</label>
                      <input type="text" name="nama_penerima" class="form-control" id="exampleFormControlInput1" placeholder="Nama Anda" required>
                    </div>
                    <div class="form-group mt-2">
                      <label for="exampleFormControlInput1">Alamat Lengkap</label>
                      <input type="text" name="alamat" class="form-control" id="exampleFormControlInput1" placeholder="Alamat Anda" required>
                    </div>
                    <div class="form-group mt-2">
                      <label for="exampleFormControlSelect1">Kelurahan</label>
                      <select id="ongkir" class="form-control" id="exampleFormControlSelect1">
                        <option value="0,-">-</option>
                        @foreach ($kotas as $kota)
                            <option value="{{ $kota->harga }},{{ $kota->name }}">{{ $kota->name }} - Rp.{{ $kota->harga }},00</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group mt-2">
                      <label for="exampleFormControlTextarea1">Catatan</label>
                      <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Isi catatan khususmu disini"></textarea>
                    </div>
                    <div class="col mt-2">
                      <div class="row">
                          <h4>Total Harga Pesanan Rp.<span id="harga">{{ $totalHarga }}</span>,00</h4>
                          <input id="totalHarga" name="harga" value="{{ $totalHarga }}" type="text" hidden>
                          <input id="ongkirHarga" name="ongkir" value="0" type="text" hidden>
                          <input id="kota" name="kota" value="-" type="text" hidden>
                          <input type="text" name="reseps_id" value="{{ $reseps->pluck('id') }}" hidden>
                      </div>
                  </div>
                    <div class="form-group mt-2">
                      <button type="submit" class="btn btn-fill text-white">Pesan Sekarang</button>
                    </div>
                  </form>
              </div>
            </div>
            <div class="col-sm-6">
                <h1 class="mb-5">Resep yang dipesan</h1>
  
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
                              <p>Jumlah Pesanan : {{ $resep->keranjang_map_jumlah }}</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endforeach
            </div>
          </div>

        </div>
    </div>
    <script 
      src="https://code.jquery.com/jquery-3.6.0.slim.js" 
      integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" 
      crossorigin="anonymous"></script>
  <script>
    $('#ongkir').on('change', function() {
        var data = $(this).val();
        var ongkir = data.split(',');
        var totalHarga = $('#totalHarga').val();
        var total = parseInt(totalHarga) + parseInt(ongkir[0]);
        $('#harga').text(total);
        $('#kota').val(ongkir[1]);
        $('#ongkirHarga').val(ongkir[0]);

    });
  </script>

  @endsection