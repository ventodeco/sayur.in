@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="col">
            <div class="row">
                

            <div class="col-sm-6">
              <h1 class="mb-5">Konfirmasi Pembayaran</h1>
              <div class="row">
                <form action="{{ route('bayar-submit') }}" method="post" enctype="multipart/form-data">
                  @csrf
                    <input type="text" name="order_id" hidden value="{{ $order->id }}">
                    <div class="form-group mt-2">
                      <label for="exampleFormControlInput1">Nama</label>
                      <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Nama dalam Rekening Anda" required>
                    </div>
                    <div class="form-group mt-2">
                      <label for="exampleFormControlInput1">Nomor Rekening</label>
                      <input type="number" name="nomor_rekening" class="form-control" id="exampleFormControlInput1" placeholder="Nomor Rekening Anda" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleFormControlInput1">Nama Bank</label>
                        <input type="text" name="nama_bank" class="form-control" id="exampleFormControlInput1" placeholder="Nama Bank Anda" required>
                    </div>
                    <div class="form-group my-3">
                      <label for="">Upload Bukti Transfer</label><br>
                      <input type="file" class="form-control-file" name="path_bukti_transfer" id="" placeholder="" aria-describedby="fileHelpId">
                    </div>  
                  </div>
                    <div class="form-group mt-2">
                      <button type="submit" class="btn btn-fill text-white">Konfirmasi Bayar</button>
                    </div>
                  </form>
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