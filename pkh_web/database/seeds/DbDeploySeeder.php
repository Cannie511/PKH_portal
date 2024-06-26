<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DbDeploySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(MstCdTableSeeder::class);
        $this->call(InitDataSeeder::class);
        
        // $this->call(TestUserSeeder::class);

        Model::reguard();
    }
}
