<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';
    protected $primarykey = 'id';
    protected $fillable = ['nama_perusahaan', 'alamat', 'telepon', 'tipe_nota', 'gambar_logo', 'gambar_kartu'];
}
