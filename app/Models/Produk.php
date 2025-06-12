<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primarykey = 'id';
    protected $fillable = ['kode_produk', 'kategori_id', 'nama_produk', 'merk', 'harga_beli', 'diskon', 'harga_jual', 'stok'];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
