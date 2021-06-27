@extends('admin.templates.default')

@section('content')
	<div class="container">
    <div class="row">
      <h1>Data pesanan</h1>

    </div>

    <div class="row">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Invoice Number</th>
            <th>Jumlah Bayar</th>
            <th>Nama Penerima</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Notes</th>
            <th>Order Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pesanans as $pesanan)
            <tr>
              <td>{{$pesanan->invoice_number ?? '-'}}</td>
              <td>{{$pesanan->amount}}</td>
              <td>{{$pesanan->nama_penerima}}</td>
              <td>{{$pesanan->alamat}}</td>
              <td>{{$pesanan->kota}}</td>
              <td>{{$pesanan->notes}}</td>
              <td>{{$pesanan->status_order}}</td>
              <td>
                <a href="{{ route('detail-pesanan-admin', $pesanan->id) }}" class="btn btn-success">Detail Pesanan</a>
                <a href="{{ route('edit-pesanan', $pesanan->id) }}" class="btn btn-success">Update Pesanan</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection