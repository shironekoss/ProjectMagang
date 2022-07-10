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
                'account_username' => 'staff1',
                'account_name' => "staff-san",
                'account_password' => "123",
                'account_privileges' => [
                    'title' => "Staff_role",
                    'account_dept' => "temp",
                ],
                'account_active' => false,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'account_username' => 'staff2',
                'account_name' => "staff-kun",
                'account_password' => "123",
                'account_privileges' => [
                    'title' => "Staff_role",
                    'account_dept' => "temp",
                ],
                'account_active' => false,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
