<?php

namespace App\Http\Controllers;

use App\Kota;
use App\Order;
use App\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->roles !== 'admin') {
            return redirect(route('home'));
        }

        return view('admin.home');
    }

    public function indexResep()
    {
        $user = Auth::user();
        if ($user->roles !== 'admin') {
            return redirect(route('home'));
        }

        $reseps = Resep::all();

        $data = [
            'reseps' => $reseps
        ];
        
        return view('admin.resep.index', $data);
    }

    public function indexKota()
    {
        $user = Auth::user();
        if ($user->roles !== 'admin') {
            return redirect(route('home'));
        }

        $kotas = Kota::all();

        $data = [
            'kotas' => $kotas
        ];
        
        return view('admin.kota.index', $data);
    }

    public function indexPesanan()
    {
        $user = Auth::user();
        if ($user->roles !== 'admin') {
            return redirect(route('home'));
        }
        
        $pesanans = Order::where('status', 'paid')->get();

        $data = [
            'pesanans' => $pesanans
        ];
        
        return view('admin.pesanan.index', $data);
    }
}
