<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(RolesTableSeeder::class);
        // $this->call(PermissionSeeder::class);
        // $this->call(UsersTableSeeder::class);

        // $this->call(MstCdTableSeeder::class);
        // $this->call(InitDataSeeder::class);
        
        // // $this->call(NewsSeeder::class);
        
        // $this->call(TestUserSeeder::class);
        $this->call(UsersTableSeeder::class);
        Model::reguard();
    }
}
