<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $primarykey = 'id';
    protected $fillable = ['kode_member', 'nama', 'alamat', 'telepon'];
}
