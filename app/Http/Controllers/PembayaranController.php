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
        $jenis_bayar = $request->metode_pembayaran;
        $bayar = $request->total_bayar;

        $orders = Order::where('customer_id', Auth::user()->id)->where('status_bayar', 0)->where('kode', $request->kode)->first();
        $orders->jenis_bayar = $request->metode_pembayaran;

        if($request->poin) {
            $customer = Customer::where('id', Auth::user()->id)->first();
            $customer->poin = 0;
            $customer->save();
        }

        if ($jenis_bayar == 2) {
            $margin = $bayar * 0.01;
            $total_bayar = $bayar + $margin;
        } elseif ($jenis_bayar == 3) {
            $margin = $bayar * 0.02;
            $total_bayar = $bayar * 0.02;
        } elseif ($jenis_bayar == 4) {
            $margin = $bayar * 0.03;
            $total_bayar = $bayar * 0.03;
        } elseif ($jenis_bayar == 5) {
            $margin = $bayar * 0.04;
            $total_bayar = $bayar * 0.04;
        } else {
            $total_bayar = $bayar;
        }
        
        $orders->margin = $margin;
        $orders->total_harga = $total_bayar;

        $orders->save();

        return redirect()->route('invoice.index', ['kode' => $request->kode]);
    }
}
