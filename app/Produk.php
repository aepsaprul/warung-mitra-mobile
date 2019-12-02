<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nama',
        'kategori_id',
        'berat',
        'merek',
        'deskripsi',
        'stok',
        'harga',
        'gambar1'
    ];

    public function data_kondisi()
    {
        return $this->belongsTo('App\Kondisi', 'kondisi_id', 'id');
    }
    public function data_kategori()
    {
        return $this->belongsTo('App\Kategori', 'kategori_id', 'id');
    }

    public function data_ulasan()
    {
        return $this->hasMany('App\Ulasan', 'produk_id', 'id');
    }
}
