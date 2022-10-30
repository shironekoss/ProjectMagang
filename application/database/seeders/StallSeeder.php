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
            'NamaStall' => 'Departemen Body Welding',
            'JumlahStall' => '3',
            'NamaDepartemen' => 'Departemen Body Welding',
        ],
        [
            'NamaStall' => 'Departemen Other',
            'JumlahStall' => '2',
            'NamaDepartemen' => 'Departemen Other',
        ],
        [
            'NamaStall' => 'Departemen Subassy Minibus',
            'JumlahStall' => '2',
            'NamaDepartemen' => 'Departemen Subassy Minibus',
        ],
        [
            'NamaStall' => 'Departemen Subassy Bus',
            'JumlahStall' => '1',
            'NamaDepartemen' => 'Departemen Subassy Bus',
        ],
        [
            'NamaStall' => 'DDepartemen Paneling',
            'JumlahStall' => '2',
            'NamaDepartemen' => 'Departemen Paneling',
        ],
        [
            'NamaStall' => 'Departemen Rangka Bus',
            'JumlahStall' => '7',
            'NamaDepartemen' => 'Departemen Rangka Bus',
        ],
        [
            'NamaStall' => 'Departemen Trimming Minibus',
            'JumlahStall' => '4',
            'NamaDepartemen' => 'Departemen Trimming Minibus',
        ],
        [
            'NamaStall' => 'Departemen Trimming Bus',
            'JumlahStall' => '5',
            'NamaDepartemen' => 'Departemen Trimming Bus',
        ],
        [

        ]);
    }
}
