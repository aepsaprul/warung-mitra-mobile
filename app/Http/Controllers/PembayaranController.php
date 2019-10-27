<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('customer_id', Auth::user()->id)
        ->where('status_bayar', 0)
        ->where('kode', $request->kode)
        ->where('jenis_bayar', null)
        ->first();
        if($orders) {
            return view('pembayaran', ['orders' => $orders]);
        }
        else {
            return redirect()->route('home');
        }
    }

    public function store(Request $request)
    {
        $orders = Order::where('customer_id', Auth::user()->id)->where('status_bayar', 0)->where('kode', $request->kode)->first();
        $orders->jenis_bayar = $request->metode_pembayaran;

        if($request->poin) {
            $customer = Customer::where('id', Auth::user()->id)->first();
            $customer->poin = 0;
            $customer->save();
            $orders->total_harga = $request->total_bayar;
        }

        $orders->save();

        return redirect()->route('invoice.index', ['kode' => $request->kode]);
    }
}
