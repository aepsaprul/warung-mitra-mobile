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

            $ulasans = Ulasan::where('customer_id', $customer_id)->where('status', null)->get();
            $countUlasans = count($ulasans);
        } else {
            $countOrderSementara = 0;
            $countOrders = 0;
            $countUlasans = 0;
            $ulasans = 0;
        }

        $kategoris = Kategori::all()->groupBy('grup');
        $sliders = Slider::get();
        $slidersides = Produk::all()->random(3);
        $kebutuhanPokoks = Produk::orderBy('id', 'desc')->where('kategori_id','27')->with('data_ulasan')->limit(10)->get();
        $barangPaketans = Produk::orderBy('id', 'desc')->where('kategori_id','27')->with('data_ulasan')->limit(10)->get();

        return view('home', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrderSementara,
                'kategoris' => $kategoris, 
                'kebutuhanPokoks' => $kebutuhanPokoks,
                'barangPaketans' => $barangPaketans, 
                'sliders' => $sliders, 
                'slidersides' => $slidersides,
                'ulasans' => $ulasans,
                'countUlasans' => $countUlasans
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

            $ulasans = Ulasan::where('customer_id', $customer_id)->where('status', null)->get();
            $countUlasans = count($ulasans);
        } else {
            $countOrderSementara = 0;
            $countOrders = 0;
            $ulasans = 0;
        }        

        $data = $request->attr;

        $kategoris = Kategori::all()->groupBy('grup');
        $produks = Produk::where('nama', 'LIKE', '%'. $data . '%')
        ->orWhereHas('data_kategori', function($query) use ($data) {
            $query->where('nama', 'LIKE', '%'. $data . '%');
        })
        ->with('data_ulasan')
        ->paginate(30);

        return view('search', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrderSementara,
                'kategoris' => $kategoris, 
                'produks' => $produks,
                'ulasans' => $ulasans,
                'countUlasans' => $countUlasans
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

            $ulasans = Ulasan::where('customer_id', $customer_id)->where('status', null)->get();
            $countUlasans = count($ulasans);
        } else {
            $countOrderSementara = 0;
            $countOrders = 0;
            $ulasans = 0;
            $countUlasans = 0;
        }

        $kategoris = Kategori::all()->groupBy('grup');
        $produk = Produk::with(['data_ulasan', 'data_ulasan.data_customer'])->find($id);

        return view('detail_produk', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrderSementara,
                'kategoris' => $kategoris, 
                'produk' => $produk,
                'ulasans' => $ulasans,
                'countUlasans' => $countUlasans
            ]);
    }
}
