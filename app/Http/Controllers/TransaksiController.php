<?php

namespace App\Http\Controllers;

use App\Order;
use App\Kategori;
use App\OrderSementara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $email = Auth::user()->email;
            $orderSementaras = OrderSementara::where('kode', $email)->get();
            $countOrderSementara = count($orderSementaras);

            $customer_id = Auth::user()->id;
            $orders = Order::where('customer_id', $customer_id)->where('status_bayar', 0)->get();
            $countOrders = count($orders);

            $data_orders = Order::where('customer_id', $customer_id)
            ->with('data_order_detail')
            ->limit(5)
            ->orderBy('id', 'desc')
            ->get();
        } else {
            $countOrderSementara = 0;
        }

        $kategoris = Kategori::all()->groupBy('grup');
        
        return view('transaksi', [
            'kategoris' => $kategoris,
            'transaksi' => $countOrders,
            'order_sementara' => $countOrderSementara,
            'orders' => $data_orders
        ]);
    }

    public function detail($kode)
    {
        $orders = Order::where('kode', $kode)
        ->where('jenis_bayar', null)
        ->first();
        if($orders) {
            $orders = Order::where('kode', $kode)->first();
            return view('transaksi_detail', ['orders' => $orders]);
        }
        else {
            return redirect()->route('home');
        }
        
    }
}
