<?php

namespace App\Http\Controllers;

use App\Order;
use App\Ulasan;
use App\Kategori;
use App\OrderSementara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (Auth::user()) {
            $email = Auth::user()->email;
            $orderSementaras = OrderSementara::where('kode', $email)->get();
            $countOrderSementara = count($orderSementaras);

            $customer_id = Auth::user()->id;
            $orders = Order::where('customer_id', $customer_id)->where('status_bayar', 0)->get();
            $countOrders = count($orders);

            $ulasans = Ulasan::where('customer_id', $customer_id)->get();
            $countUlasans = count($ulasans);
        } else {
            $countOrderSementara = 0;
            $countOrders = 0;
            $ulasans = 0;
        }
        
        $kategoris = Kategori::all()->groupBy('grup');
        $profil = Auth::user();
        
        return view('profil', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrderSementara,
                'kategoris' => $kategoris, 
                'profil' => $profil,
                'ulasans' => $ulasans,
                'countUlasans' => $countUlasans
            ]);
    }
}
