<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenDB_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('DB_Departemen')->insert([
            [
                'Nama_Departemen' => 'Departemen Body Welding',
                'Jumlah_account' => 2,
                'AksesTipeDatabase'=>['SPK MINI BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Putty',
                'Jumlah_account' => 2,
                'AksesTipeDatabase'=>['SPK MINI BUS','SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Painting',
                'Jumlah_account' => 2,
                'AksesTipeDatabase'=>['SPK MINI BUS','SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Other',
                'Jumlah_account' => 3,
                'AksesTipeDatabase'=>['SPK MINI BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Subassy',
                'AksesTipeDatabase'=>['SPK BUS'],
                'Jumlah_account' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Paneling',
                'Jumlah_account' => 2,
                'AksesTipeDatabase'=>['SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Rangka Bus',
                'Jumlah_account' => 2,
                'AksesTipeDatabase'=>['SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Trimming',
                'Jumlah_account' => 2,
                'AksesTipeDatabase'=>['SPK MINI BUS','SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Finishing',
                'Jumlah_account' => 2,
                'AksesTipeDatabase'=>['SPK MINI BUS','SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
