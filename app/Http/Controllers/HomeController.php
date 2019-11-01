<?php

namespace App\Http\Controllers;

use App\Order;
use App\Produk;
use App\Slider;
use App\Kategori;
use App\OrderSementara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        $sliders = Slider::get();
        $slidersides = Produk::all()->random(3);
        $produks = Produk::orderBy('id', 'desc')->paginate(30);

        return view('home', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrderSementara,
                'kategoris' => $kategoris, 
                'produks' => $produks, 
                'sliders' => $sliders, 
                'slidersides' => $slidersides
            ]);
    }

    public function search(Request $request)
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

        $data = $request->attr;

        $kategoris = Kategori::all()->groupBy('grup');
        $produks = Produk::where('nama', 'LIKE', '%'. $data . '%')
        ->orWhereHas('data_kategori', function($query) use ($data) {
            $query->where('nama', 'LIKE', '%'. $data . '%');
        })
        ->paginate(30);

        return view('search', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrderSementara,
                'kategoris' => $kategoris, 
                'produks' => $produks
            ]);
    }

    public function detail_produk($id)
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

        $kategoris = Kategori::get();
        $produk = Produk::find($id);

        return view('detail_produk', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrderSementara,
                'kategoris' => $kategoris, 
                'produk' => $produk
            ]);
    }
}
