<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('psadmin@whizzlogy'),
            'created_by' => 1,
            'updated_by' => null,
        ]);
        
        User::create([
            'id' => 2,
            'name' => 'Theekshani',
            'email' => 'theekshani@middeniya.whizzlogy',
            'user_type' => 'user',
            'password' => Hash::make('pstheekshani@middeniya.whizzlogy'),
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
            'name' => 'Theekshani',
            'email' => 'theekshani@weeraketiya.whizzlogy',
            'user_type' => 'user',
            'password' => Hash::make('pstheekshani@weeraketiya.whizzlogy'),
            'created_by' => 1,
            'updated_by' => null,
        ]);
        
        User::create([
            'id' => 6,
            'name' => 'Uththara',
            'email' => 'uththara@weeraketiya.whizzlogy',
            'user_type' => 'user',
            'password' => Hash::make('psuththara@weeraketiya.whizzlogy'),
            'created_by' => 1,
            'updated_by' => null,
        ]);

        User::create([
            'id' => 7,
            'name' => 'Anuththara',
            'email' => 'anuththara@middeniya.whizzlogy',
            'user_type' => 'user',
            'password' => Hash::make('psauththara@middeniya.whizzlogy'),
            'created_by' => 1,
            'updated_by' => null,
        ]);
    }
}
