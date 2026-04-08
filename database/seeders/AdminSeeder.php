<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    //      admin@powersmile.wiz
    //      powersmile@wiz

    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'super_admin',
            'email' => 'admin@powersmile.wiz',
            'user_type' => 'super_admin',
            'password' => '$2y$10$xvxH5hYkD8DeUxj1ZHaq3unPqz.2LNs99VZifuauXODAmi6IYcSKy',
            'created_by' => 1,
            'updated_by' => null,
        ]);
        User::create([
            'id' => 2,
            'name' => 'theekshani',
            'email' => 'theekshani@middeniya.wiz',
            'user_type' => 'user',
            'password' => '$2y$10$iEgxjYjBXLEz.ojbchK1zOkpAfdn8IjdNzMUHtSuMoUVWOASLn2da',
            'created_by' => 1,
            'updated_by' => null,
        ]);
        User::create([
            'id' => 3,
            'name' => 'tashila',
            'email' => 'tashila@weeraketiya.wiz',
            'user_type' => 'user',
            'password' => '$2y$10$uVKxJwyjeBJ1M6q9jRz06e1wEdJSDcbu0afUn/tbuozLaBB9aFKWG',
            'created_by' => 1,
            'updated_by' => null,
        ]);
        User::create([
            'id' => 4,
            'name' => 'Sashini',
            'email' => 'sashini@middeniya.wiz',
            'user_type' => 'user',
            'password' => '$2y$10$XXzs0CLTDDyayJDhrdBhcuDv4sE3gOdK82O3/IvOtrVT/pg0yLy8e',
            'created_by' => 1,
            'updated_by' => null,
        ]);
        User::create([
            'id' => 5,
            'name' => 'theekshani',
            'email' => 'theekshani@weeraketiya.wiz',
            'user_type' => 'user',
            'password' => '$2y$10$H27HmoUx/42CE99.r6hxZe7YxNrGzTakhipoQB1WdZK2yRWakO7vq',
            'created_by' => 1,
            'updated_by' => null,
        ]);
    }
}
