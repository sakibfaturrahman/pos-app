<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            'id' => 1,
            'nama_perusahaan' => 'SAFA',
            'alamat' => 'Jl. Abroor ,Kec Cisayong, Kab Tasikmalaya',
            'telepon' => '085282732609',
            'tipe_nota' => 1, // Nota kecil
            'diskon' => 8,
            'gambar_logo' => '/img/logo.png',
            'gambar_kartu' => '/img/member.png',
        ]);
    }
}
