<?php

namespace Database\Seeders;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('accounts')->insert([
            [
                'account_username' => 'elfan',
                'account_name' => "elfan",
                'account_password' => "elfan",
                'account_privileges' => [
                    'title' => "Super_Admin_role",
                    'account_dept' => "SPK Dept",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'felis',
                'account_name' => "felis",
                'account_password' => "felis",
                'account_privileges' => [
                    'title' => "Admin_role",
                    'account_dept' => "SPK Dept",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'charles',
                'account_name' => "charles",
                'account_password' => "charles",
                'account_privileges' => [
                    'title' => "Staff_role",
                    'account_dept' => "SPK Dept",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'Heru1234',
                'account_name' => "Heru",
                'account_password' => "12345678",
                'account_privileges' => [
                    'title' => "Admin",
                    'account_dept' => "Departemen Body Welding",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'Heru1235',
                'account_name' => "Heru",
                'account_password' => "12345678",
                'account_privileges' => [
                    'title' => "Admin",
                    'account_dept' => "Departemen Subassy Minibus",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'Yohanes123',
                'account_name' => "Yohanes",
                'account_password' => "12345678",
                'account_privileges' => [
                    'title' => "Admin",
                    'account_dept' => "Departemen Subassy Bus",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'adit1231',
                'account_name' => "Adit",
                'account_password' => "12345678",
                'account_privileges' => [
                    'title' => "Admin",
                    'account_dept' => "Departemen Paneling",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'adit12311',
                'account_name' => "Adit",
                'account_password' => "12345678",
                'account_privileges' => [
                    'title' => "Admin",
                    'account_dept' => "Departemen Rangka Bus",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'adit123111a',
                'account_name' => "Adit",
                'account_password' => "12345678",
                'account_privileges' => [
                    'title' => "Admin",
                    'account_dept' => "Departemen Trimming Mini bus",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'Denny123',
                'account_name' => "Denny",
                'account_password' => "12345678",
                'account_privileges' => [
                    'title' => "Admin",
                    'account_dept' => "Departemen Trimming Bus",
                ],
                'account_active' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
