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
        DB::table('Departemen_DB')->insert([
            [
                'Nama_Departemen' => 'Departemen Body Welding',
                'AksesTipeDatabase'=>['SPK MINI BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Putty Minibus',
                'AksesTipeDatabase'=>['SPK MINI BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Painting Minibus',
                'AksesTipeDatabase'=>['SPK MINI BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Trimming Minibus',
                'AksesTipeDatabase'=>['SPK MINI BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Finishing Minibus',
                'AksesTipeDatabase'=>['SPK MINI BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Sub Assy Minibus',
                'AksesTipeDatabase'=>['SPK MINI BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Rangka',
                'AksesTipeDatabase'=>['SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Paneling',
                'AksesTipeDatabase'=>['SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Putty Bus',
                'AksesTipeDatabase'=>['SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Painting Bus',
                'AksesTipeDatabase'=>['SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Trimming Bus',
                'AksesTipeDatabase'=>['SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Finishing Bus',
                'AksesTipeDatabase'=>['SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Sub Assy Bus',
                'AksesTipeDatabase'=>['SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'Nama_Departemen' => 'Departemen Other',
                'AksesTipeDatabase'=>['SPK MINI BUS','SPK BUS'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
