<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repositories\BillingRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BillingController extends Controller
{
    private $billingRepository;
    private $orderRepository;

    public function __construct(
        BillingRepository $billingRepository,
        OrderRepository $orderRepository
    ) {
        $this->billingRepository = $billingRepository;
        $this->orderRepository = $orderRepository;
    }

    public function bayar(Order $order)
    {
        $data = [
            'order' => $order
        ]; 
        return view('billing', $data);
    }

    public function bayarSubmit(Request $request)
    {
        $request['user_id'] = Auth::id();
        $contents = $request->file('path_bukti_transfer');
        $path = Storage::put('/public/images', $contents, 'public');
        $path = preg_replace('/public/', '', $path);
        $request['bukti_transfer'] = $path;
        $this->billingRepository->create($request->toArray());
        $order = $this->orderRepository->getById($request['order_id']);
        $order = $this->orderRepository->changeToPaid($order);
        return redirect(route('pesanan'));
    }
}
