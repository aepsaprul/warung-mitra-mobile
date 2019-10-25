<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode', 'produk_id', 'qty', 'harga'
    ];

    public function data_order()
    {
        return $this->belongsTo('App\Order', 'kode', 'kode');
    }

    public function data_produk()
    {
        return $this->belongsTo('App\Produk', 'produk_id', 'id');
    }
}
