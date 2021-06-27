@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="col">
          <div class="row mb-5">
            <h1>Daftar Resep</h1>
          </div>
        </div>
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
                    {{ $resep->deskripsi }}
                  </p>
                </div>
                <div class="card-btn-space">
                <form action="{{ route('resep', $resep->id) }}">
                    <button type="submit" class="btn btn-outline">Lihat Detail Resep</button>
                </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
    </div>
  @endsection