<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $primarykey = 'id';
    protected $fillable = ['supplier_id', 'total_item', 'total_harga', 'diskon', 'bayar'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id', 'id');
    }
}
