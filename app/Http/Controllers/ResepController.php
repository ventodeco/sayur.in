<?php

namespace App\Http\Controllers;

use App\Repositories\KeranjangMapRepository;
use App\Repositories\ResepRepository;
use App\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    public function __construct(
        ResepRepository $resepRepository,
        KeranjangMapRepository $keranjangMapRepository
    )
    {
        $this->resepRepository = $resepRepository;
        $this->keranjangMapRepository = $keranjangMapRepository;
    }

    public function index()
    {
        $reseps = $this->resepRepository->getAllResep();
        $data = [
            'reseps' => $reseps
        ];
        return view('cari-resep-index', $data);
    }

    public function getDetail(Resep $resep)
    {
        $data = [
            'resep' => $resep
        ];
        return view('detail-resep', $data);
    }

    public function fillKeranjang(Resep $resep)
    {
        $userId = Auth::id();
        $resepId = $resep->id;

        $data = [
            'userId'  => $userId,
            'resepId' => $resepId
        ];

        $map = $this->keranjangMapRepository->getByResepAndUserId($userId, $resepId);
        if ($map) {
            $this->keranjangMapRepository->iterateJumlah($map);
        } else {
            $this->keranjangMapRepository->save($data);
        }

        return redirect(route('show-keranjang'));
    }

    public function create()
    {
        $data = [
            'resep' => ''
        ];
        return view('admin.resep.form', $data);
    }

    public function formSubmit(Request $request)
    {
        $data = $request->except(['_token']);

        if (isset($data['resep_id'])) {
            $resep = $this->resepRepository->getById($data['resep_id']);
            unset($data['resep_id']);
            $this->resepRepository->update($resep, $data);
        } else {
            $this->resepRepository->create($data);
        }

        return redirect(route('dashboard.resep'));
    }

    public function edit(Resep $resep)
    {
        $data = [
            'resep' => $resep
        ];

        return view('admin.resep.form', $data);
    }

    public function delete(Resep $resep)
    {
        $resep->delete();

        return redirect(route('dashboard.resep'));
    }
}
