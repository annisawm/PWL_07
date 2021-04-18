<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;


class MahasiswaMataKuliahSeeder extends Seeder
{

    public function run()
    {
        $data = [
        [
            'mahasiswa_id' => Mahasiswa::min('nim'),
            'matakuliah_id' => Matakuliah::min('id'),
            'nilai' => 'A',
        ],
        [
            'mahasiswa_id' => Mahasiswa::min('nim'),
            'matakuliah_id' => Matakuliah::min('id'),
            'nilai' => 'A',
        ],
        [
            'mahasiswa_id' => Mahasiswa::min('nim'),
            'matakuliah_id' => Matakuliah::min('id'),
            'nilai' => 'B+',
        ],
        [
            'mahasiswa_id' => Mahasiswa::min('nim'),
            'matakuliah_id' => Matakuliah::min('id'),
            'nilai' => 'A',
        ],
    ];
        DB::table('mahasiswa_matakuliah')->insert($data);
    }
}