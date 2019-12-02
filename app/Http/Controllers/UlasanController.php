<?php

namespace App\Http\Controllers;

use App\Order;
use App\Produk;
use App\Slider;
use App\Ulasan;
use App\Kategori;
use App\OrderSementara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index($id)
    {
        if (Auth::user()) {
            $email = Auth::user()->email;
            $orderSementaras = OrderSementara::where('kode', $email)->get();
            $countOrderSementara = count($orderSementaras);

            $customer_id = Auth::user()->id;
            $orders = Order::where('customer_id', $customer_id)->where('status_bayar', 0)->get();
            $countOrders = count($orders);

            $ulasans = Ulasan::where('customer_id', $customer_id)->where('status', null)->get();
            $countUlasans = count($ulasans);
        } else {
            $countOrderSementara = 0;
            $countOrders = 0;
            $countUlasans = 0;
        }

        $kategoris = Kategori::all()->groupBy('grup');
        $sliders = Slider::get();
        $ulasan = Ulasan::find($id);
        $produk = Produk::find($ulasan->produk_id);

        return view('ulasan', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrderSementara,
                'kategoris' => $kategoris,
                'ulasans' => $ulasans,
                'ulasan' => $ulasan,
                'countUlasans' => $countUlasans,
                'produk' => $produk
            ]);
    }

    public function store(Request $request)
    {
        $ulasan = Ulasan::find($request->ulasan_id);
        $ulasan->star = $request->rate;
        $ulasan->komentar = $request->komentar;
        $ulasan->status = 1;
        $ulasan->save();

        return response()->json([
            'data' => "sukses"
        ]);
    }
}
