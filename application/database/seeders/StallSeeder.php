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
                'NamaStall' => 'Stall Body Welding',
                'JumlahStall' => '3',
                'NamaDepartemen' => 'Departemen Body Welding',
            ],
            [
                'NamaStall' => 'Stall Putty Minibus',
                'JumlahStall' => '3',
                'NamaDepartemen' => 'Departemen Putty Minibus',
            ],
            [
                'NamaStall' => 'Stall Painting Minibus',
                'JumlahStall' => '2',
                'NamaDepartemen' => 'Departemen Painting Minibus',
            ],
            [
                'NamaStall' => 'Stall Trimming Minibus',
                'JumlahStall' => '9',
                'NamaDepartemen' => 'Departemen Trimming Minibus',
            ],
            [
                'NamaStall' => 'Stall Finishing Minibus',
                'JumlahStall' => '3',
                'NamaDepartemen' => 'Departemen Finishing Minibus',
            ],
            [
                'NamaStall' => 'Stall Sub Assy Minibus',
                'JumlahStall' => '8',
                'NamaDepartemen' => 'Departemen Sub Assy Minibus',
            ],
            [
                'NamaStall' => 'Stall Rangka Bus',
                'JumlahStall' => '1',
                'NamaDepartemen' => 'Departemen Rangka Bus',
            ],
            [
                'NamaStall' => 'Stall Paneling',
                'JumlahStall' => '6',
                'NamaDepartemen' => 'Departemen Paneling',
            ],
            [
                'NamaStall' => 'Stall Putty Bus',
                'JumlahStall' => '3',
                'NamaDepartemen' => 'Departemen Putty Bus',
            ],
            [
                'NamaStall' => 'Stall Painting Bus',
                'JumlahStall' => '2',
                'NamaDepartemen' => 'Departemen Painting Bus',
            ],
            [
                'NamaStall' => 'Stall Trimming Bus',
                'JumlahStall' => '8',
                'NamaDepartemen' => 'Departemen Trimming Bus',
            ],
            [
                'NamaStall' => 'Stall Finishing Bus',
                'JumlahStall' => '7',
                'NamaDepartemen' => 'Departemen Finishing Bus',
            ],
            [
                'NamaStall' => 'Departemen Sub Assy Bus',
                'JumlahStall' => '6',
                'NamaDepartemen' => 'Departemen Sub Assy Bus',
            ],
            [
                'NamaStall' => 'Departemen Other',
                'JumlahStall' => '2',
                'NamaDepartemen' => 'Departemen Other',
            ],
        ]);
    }
}
