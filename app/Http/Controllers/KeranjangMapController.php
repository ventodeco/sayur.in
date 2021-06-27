<?php

namespace App\Http\Controllers;

use App\KeranjangMap;
use App\Repositories\KeranjangMapRepository;
use App\Repositories\KotaRepository;
use App\Repositories\ResepRepository;
use App\Resep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeranjangMapController extends Controller
{
    public function __construct(
        KeranjangMapRepository $keranjangMapRepository,
        ResepRepository $resepRepository,
        KotaRepository $kotaRepository
    ) {
        $this->keranjangMapRepository = $keranjangMapRepository;
        $this->resepRepository = $resepRepository;
        $this->kotaRepository = $kotaRepository;
    }

    public function show()
    {
        $userId = Auth::id();
        $isiKeranjang = $this->keranjangMapRepository->getByUserId($userId);
        $idKeranjang = $isiKeranjang->pluck('resep_id');
        $reseps = $this->resepRepository->getResepByBulkId($idKeranjang->toArray());

        $harga = 0;
        foreach ($isiKeranjang as $isi) {
            $harga += ($isi->resep->harga * $isi->jumlah);
        }

        $data = [
            'reseps' => $reseps,
            'totalHarga' => $harga
        ];
        return view('keranjang', $data);
    }

    public function delete(Resep $resep)
    {
        $userId = Auth::id();
        $this->keranjangMapRepository->deleteByResepId($resep->id, $userId);

        return redirect(route('show-keranjang'));
    }

    public function checkout()
    {
        $userId = Auth::id();
        $isiKeranjang = $this->keranjangMapRepository->getByUserId($userId);
        $idKeranjang = $isiKeranjang->pluck('resep_id');
        $reseps = $this->resepRepository->getResepByBulkId($idKeranjang->toArray());

        $harga = 0;
        foreach ($isiKeranjang as $isi) {
            $harga += ($isi->resep->harga * $isi->jumlah);
        }

        $kotas = $this->kotaRepository->getAll();

        $data = [
            'kotas'      => $kotas,
            'reseps'     => $reseps,
            'totalHarga' => $harga
        ];
        return view('checkout', $data);
    }

    public function changeValue(Request $request)
    {
        $map = $this->keranjangMapRepository->getById($request['map_id']);
        
        $this->keranjangMapRepository->changeValue($request['jumlah'], $map);

        return redirect()->back();
    }
}
