<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repositories\KeranjangMapRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ResepRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private $orderRepository;
    private $orderDetailRepository;
    private $resepRepository;
    private $keranjangMapRepository;

    public function __construct(
        OrderRepository $orderRepository,
        ResepRepository $resepRepository,
        OrderDetailRepository $orderDetailRepository,
        KeranjangMapRepository $keranjangMapRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->resepRepository = $resepRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->keranjangMapRepository = $keranjangMapRepository;
    }

    public function createOrder(Request $request)
    {
        $request['user_id'] = Auth::id();
        $request['amount'] = $request['harga'] + $request['ongkir'];
        $ids = $request['reseps_id'];

        unset($request['harga']);
        unset($request['ongkir']);
        unset($request['reseps_id']);

        $request['status']       = Order::STATUS_UNPAID;
        $request['order_status'] = Order::STATUS_PROCESSING;
        $order = $this->orderRepository->create($request->toArray());
        $order = $this->orderRepository->generateInvoiceNumber($order);

        $ids = $this->regexResepsId($ids);

        $this->saveToOrderDetail($ids, $order->id);

        return redirect(route('pesanan'));
    }

    public function pesanan()
    {
        $id = Auth::id();

        $orders = $this->orderRepository->getOrderByUserId($id);

        $data = [
            'orders' => $orders
        ];

        return view('pesanan', $data);
    }

    public function detailPesanan(Order $order)
    {
        $data = [
            'order' => $order
        ];

        return view('detail-pesanan', $data);
    }

    private function regexResepsId(string $str)
    {
        $id = str_replace('[', '', $str);
        $id = str_replace(']', '', $id);
        $id = explode(',', $id);
        
        return $id;
    }

    private function saveToOrderDetail(array $idsResep, int $orderId)
    {
        $reseps = $this->resepRepository->getResepByBulkId($idsResep);
        foreach($reseps as $resep) {
            $data['order_id'] = $orderId;
            $data['name']     = $resep->name;
            $data['path']     = $resep->image;
            $data['jumlah']   = $resep->keranjang_map_jumlah;
            $data['harga']    = $resep->harga;

            $map = $this->keranjangMapRepository->getById($resep->keranjang_map_id);
            $orderDetail = $this->orderDetailRepository->create($data);
            
            $map = $this->keranjangMapRepository->flagMap($map);
            $resep = $this->resepRepository->updateStock($resep);
        }
    }

    public function edit(Order $pesanan)
    {
        $data = [
            'pesanan' => $pesanan
        ];
        return view('admin.pesanan.form', $data);
    }

    public function formSubmit(Request $request)
    {
        $data = $request->except(['_token']);

        $pesanan = $this->orderRepository->getById($data['pesanan_id']);
        unset($data['pesanan_id']);
        $this->orderRepository->update($pesanan, $data);

        return redirect(route('dashboard.pesanan'));
    }

    public function detail(Order $pesanan)
    {
        $data = [
            'pesanan' => $pesanan
        ];
        return view('admin.pesanan.detail', $data);
    }
}
