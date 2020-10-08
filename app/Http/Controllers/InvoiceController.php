<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::where('customer_id', Auth::user()->id)->where('status_bayar', 0)->where('kode', $request->kode)->first();
        $orders = OrderDetail::where('kode', $order->kode)->get();

        return view('invoice', ['order' => $order, 'orders' => $orders]);
    }
}
