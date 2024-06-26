<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('UsersTableSeeder');
        DB::table('users')->delete();

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
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'it@phankhangco.com',
                'password'       => bcrypt('123456789'),
                'email_verified' => '1',
                'roles'          => [1]
            ]
        ];

        $ruid = 0;
        foreach ($users as $user) {
            
            $roles = $user['roles'];
            unset($user['roles']);
            // $user['password'] = bcrypt('123456');
            User::create($user);

            if( isset($roles) && !empty($roles)) {
                foreach ($roles as $role) {
                    $ruid++;
                    $ru = [
                        'id' => $ruid,
                        'role_id' => $role,
                        'user_id' => $user['id']
                    ];
                    $ru["created_at"] = \Carbon\Carbon::now()->toDateTimeString();
                    $ru["updated_at"] = \Carbon\Carbon::now()->toDateTimeString();

                    DB::table('role_user')->insert($ru);
                }
            }
        }
    }
}
