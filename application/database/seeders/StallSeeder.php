<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('DB_Stall')->insert([
            [
                'NamaStall' => 'Departemen Body Welding',
                'JumlahStall' => '3',
                'NamaDepartemen' => 'Departemen Body Welding',
            ],
             [
                'NamaStall' => 'Departemen Putty',
                'JumlahStall' => '3',
                'NamaDepartemen' => 'Departemen Putty',
            ],
             [
                'NamaStall' => 'Departemen Painting',
                'JumlahStall' => '3',
                'NamaDepartemen' => 'Departemen Painting',
            ],
            [
                'NamaStall' => 'Departemen Other',
                'JumlahStall' => '2',
                'NamaDepartemen' => 'Departemen Other',
            ],
            [
                'NamaStall' => 'Departemen Subassy',
                'JumlahStall' => '1',
                'NamaDepartemen' => 'Departemen Subassy',
            ],
            [
                'NamaStall' => 'Departemen Paneling',
                'JumlahStall' => '2',
                'NamaDepartemen' => 'Departemen Paneling',
            ],
            [
                'NamaStall' => 'Departemen Rangka Bus',
                'JumlahStall' => '7',
                'NamaDepartemen' => 'Departemen Rangka Bus',
            ],
            [
                'NamaStall' => 'Departemen Trimming',
                'JumlahStall' => '5',
                'NamaDepartemen' => 'Departemen Trimming',
            ],
            [
                'NamaStall' => 'Departemen Finishing',
                'JumlahStall' => '5',
                'NamaDepartemen' => 'Departemen Finishing',
            ]
        ]);
    }
}
