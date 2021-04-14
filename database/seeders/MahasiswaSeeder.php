<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mhs = [
            [
                'nim' => '194234324',
                'nama' => 'Anisa',
                'kelas_id' => '1',
                'jurusan' => 'Teknologi Informasi',
                'no_tlp' => '08343534',
                'tgl_lahir' => '08 September 2000',
                'email' => 'anisa@gmail.com'
            ]
        ];

        DB::table('mahasiswa')->insert($mhs);
    }
}
