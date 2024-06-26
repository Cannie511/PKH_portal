<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    private $roles = [
            [
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'administrator',
                'description' => 'Quản trị hệ thống',
                'level' => '500'
            ],
            [
                'id' => 2,
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Quản lý',
                'level' => '490'
            ],
            [
                'id' => 3,
                'name' => 'Sales Manager',
                'slug' => 'sale-manager',
                'description' => 'Quản lý',
                'level' => '490'
            ],
            [
                'id' => 4,
                'name' => 'Sales Admin',
                'slug' => 'sales-admin',
                'description' => 'Cordinator',
                'level' => '490'
            ],
            [
                'id' => 5,
                'name' => 'Sales',
                'slug' => 'sales',
                'description' => 'Nhân viên bán hàng',
                'level' => '490'
            ],
            [
                'id' => 6,
                'name' => 'Accountant',
                'slug' => 'accountant',
                'description' => 'Kế toán',
                'level' => '490'
            ],
            [
                'id' => 7,
                'name' => 'Warehouse',
                'slug' => 'warehouse',
                'description' => 'Thủ kho',
                'level' => '490'
            ],
            [
                'id' => 8,
                'name' => 'Customer',
                'slug' => 'customer',
                'description' => 'Khách hàng',
                'level' => '490'
            ],
            [
                'id' => 9,
                'name' => 'Supplier',
                'slug' => 'supplier',
                'description' => 'Nhà cung cấp',
                'level' => '490'
            ],
            [
                'id' => 10,
                'name' => 'IT',
                'slug' => 'it',
                'description' => 'IT',
                'level' => '490'
            ],
            [
                'id' => 11,
                'name' => 'Sale Admin 2',
                'slug' => 'sale-admin-2',
                'description' => 'Sale Admin 2',
                'level' => '490'
            ],
            [
                'id' => 12,
                'name' => 'Internal Audit',
                'slug' => 'internal-audit',
                'description' => 'Internal Audit',
                'level' => '490'
            ],
            [
                'id' => 18,
                'name' => 'Internship',
                'slug' => 'internship',
                'description' => 'internship',
                'level' => '300'
            ]
        ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('RolesTableSeeder');

        // Create all
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        // DB::table('users')->truncate();

        $this->createRole();
    }

    private function createRole() {

        foreach ($this->roles as $item) {
            $item["created_at"] = \Carbon\Carbon::now()->toDateTimeString();
            $item["updated_at"] = \Carbon\Carbon::now()->toDateTimeString();

            DB::table('roles')->insert($item);
        }
    }

}
