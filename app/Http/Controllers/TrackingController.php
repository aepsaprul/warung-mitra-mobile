<?php

namespace App\Http\Controllers;

use App\Order;
use App\Kategori;
use App\Tracking;
use App\OrderSementara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
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
        } else {
            $countOrderSementara = 0;
            $countOrders = 0;
        }

        $kategoris = Kategori::all()->groupBy('grup');

        return view('tracking', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrderSementara,
                'kategoris' => $kategoris
            ]);
    }

    public function show(Request $request)
    {
        $trackings = Tracking::where('kode', $request->kode)->get();

        return response()->json([
            'data' => $trackings
        ]);
    }
}
