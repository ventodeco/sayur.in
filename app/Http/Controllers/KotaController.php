<?php

namespace App\Http\Controllers;

use App\Kota;
use App\Repositories\KotaRepository;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function __construct(
        KotaRepository $kotaRepository
    )
    {
        $this->kotaRepository = $kotaRepository;
    }

    public function create()
    {
        $data = [
            'kota' => ''
        ];
        return view('admin.kota.form', $data);
    }

    public function formSubmit(Request $request)
    {
        $data = $request->except(['_token']);

        if (isset($data['kota_id'])) {
            $kota = $this->kotaRepository->getById($data['kota_id']);
            unset($data['kota_id']);
            $this->kotaRepository->update($kota, $data);
        } else {
            $this->kotaRepository->create($data);
        }

        return redirect(route('dashboard.kota'));
    }

    public function edit(Kota $kota)
    {
        $data = [
            'kota' => $kota
        ];

        return view('admin.kota.form', $data);
    }

    public function delete(Kota $kota)
    {
        $kota->delete();

        return redirect(route('dashboard.kota'));
    }
}
