<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::where('customer_id', Auth::user()->id)->where('status_bayar', 0)->where('kode', $request->kode)->first();
        return view('invoice', ['order' => $order]);
    }
}
