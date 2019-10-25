<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode', 
        'customer_id', 
        'tanggal', 
        'nama', 
        'alamat', 
        'desa',
        'rt',
        'rw',
        'kecamatan', 
        'kabupaten',
        'kode_pos',
        'dropshipper',
        'dropshipper_nama',
        'dropshipper_detail',
        'total_harga', 
        'ongkir', 
        'total_bayar', 
        'status_bayar', 
        'jenis_bayar'
    ];

    public function data_customer()
    {
        return $this->belongsTo('App\User', 'customer_id', 'id');
    }
    public function data_order_detail()
    {
        return $this->hasMany('App\OrderDetail', 'kode', 'kode');
    }
}
