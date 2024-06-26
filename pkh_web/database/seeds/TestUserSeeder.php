<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Roles;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        // 1   administrator
        // 2   manager
        // 3   sale-manager
        // 4   sales-admin
        // 5   sales
        // 6   accountant
        // 7   warehouse
        // 8   customer
        // 9   supplier
        // 10  IT
        
        User::where('email', 'like', '%user%')->delete();

        for( $i = 1 ; $i <= 10 ; $i++) {
            $u = User::create([
                'name'           => 'user' . $i,
                'email'          => 'user' . $i . '@phankhangco.com',
                'password'       => bcrypt('123456'),
                'email_verified' => '1'
            ]);
            $u->attachRole(Roles::find($i));
        }
    }
}
