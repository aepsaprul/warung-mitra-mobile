<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ulasan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'produk_id', 'customer_id', 'star', 'komentar', 'status'
    ];

    public function data_produk()
    {
        return $this->belongsTo('App\Produk', 'produk_id', 'id');
    }

    public function data_customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }
}
