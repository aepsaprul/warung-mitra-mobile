<?php

namespace App\Http\Controllers;

use App\Order;
use App\Produk;
use App\Kategori;
use App\OrderSementara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $email = Auth::user()->email;
            $order_sementaras = OrderSementara::where('kode', $email)->get();
            $countOrder = count($order_sementaras);

            $id = Auth::user()->id;
            $orders = Order::where('customer_id', $id)->where('status_bayar', 0)->get();
            $countOrders = count($orders);
        } else {
            $countOrder = 0;
        }

        $kategoris = Kategori::all()->groupBy('grup');

        return view('keranjang', [
                'transaksi' => $countOrders,
                'order_sementara' => $countOrder,
                'kategoris' => $kategoris
            ]);
    }

    public function masukkan_keranjang(Request $request, $id)
    {
        if (Auth::user()) {
            $produk = Produk::find($id);
            $produkStok = $produk->stok;
            $sisaStok = $produkStok - 1;
            $produk->stok = $sisaStok;
            $produk->save();

            $email = Auth::user()->email;
            $order_sementara = OrderSementara::where('kode', $email)->where('produk_id', $id)->first();

            if ($order_sementara) {
                $order_sementara->qty = $order_sementara->qty + 1;
                $order_sementara->harga = $order_sementara->harga + $produk->harga;
                $order_sementara->save();
            } else {
                OrderSementara::create([
                    'produk_id' => $id,
                    'qty' => 1,
                    'harga' => $produk->harga,
                    'kode' => Auth::user()->email
                ]);
            }


            if ($produk->stok == 0) {
                # code...
                $request->session()->flash('stok', 'Stok habis');
            }
            
            $request->session()->flash('status', 'Berhasil masuk keranjang');

            return redirect()->route('detail_produk', ['id' => $id]);
        } else {
            return redirect()->route('login');
        }
    }

    public function beli(Request $request, $id)
    {
        if (Auth::user()) {
            $produk = Produk::find($id);
            $produkStok = $produk->stok;
            $sisaStok = $produkStok - 1;
            $produk->stok = $sisaStok;
            $produk->save();

            $email = Auth::user()->email;
            $order_sementara = OrderSementara::where('kode', $email)->where('produk_id', $id)->first();

            if ($order_sementara) {
                $order_sementara->qty = $order_sementara->qty + 1;
                $order_sementara->harga = $order_sementara->harga + $produk->harga;
                $order_sementara->save();
            } else {
                OrderSementara::create([
                    'produk_id' => $id,
                    'qty' => 1,
                    'harga' => $produk->harga,
                    'kode' => Auth::user()->email
                ]);
            }

            return redirect()->route('keranjang.index');
        } else {
            return redirect()->route('login');
        }
    }

    public function data()
    {
        $email = Auth::user()->email;
        $orderSementaras = OrderSementara::where('kode', $email)
            ->with('data_produk')
            ->get();

        return response()->json([
            'data' => $orderSementaras
        ]);
    }

    public function tambah_data(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;
        $email = Auth::user()->email;

        $order_sementara = OrderSementara::where('kode', $email)->where('produk_id', $id)->first();
        $order_sementara->delete();

        $produk = Produk::find($id);

        $orderSementaras = OrderSementara::create([
            'produk_id' => $id,
            'qty' => $qty,
            'harga' => $produk->harga * $qty,
            'kode' => $email
        ]);

        return response()->json([
            'data' => $orderSementaras
        ]);
    }

    public function hapus($id)
    {
        $orderSementara = OrderSementara::where('id', $id)->first();

        $produk = Produk::find($orderSementara->produk_id);
        $produkStok = $produk->stok;
        $sisaStok = $produkStok + $orderSementara->qty;
        $produk->stok = $sisaStok;
        $produk->save();

        $orderSementara->delete();

        return redirect()->route('keranjang.index');
    }
}
