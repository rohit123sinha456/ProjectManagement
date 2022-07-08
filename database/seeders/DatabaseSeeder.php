<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $users =  [
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=> bcrypt('admin'),
                'role'=>2
             ],
             [
                'name'=>'pm',
                'email'=>'pm@gmail.com',
                'password'=> bcrypt('pm'),
                'role'=>1
             ],
             [
                'name'=>'resource',
                'email'=>'resource@gmail.com',
                'password'=> bcrypt('resource'),
                'role'=>0
             ],
        ];
        User::create($users[0]);
        User::create($users[1]);
        User::create($users[2]);
    }
}
