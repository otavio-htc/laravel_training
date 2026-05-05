<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // create multiple users
        DB::table('users')->insert([

            [

                'username' => 'user1@email.com',
                'password' => bcrypt('admin123'),
                'created_at' => date('Y-m-d H:i:s'),

            ],
            [

                'username' => 'user2@email.com',
                'password' => bcrypt('admin123'),
                'created_at' => date('Y-m-d H:i:s'),

            ],
            [

                'username' => 'user3@email.com',
                'password' => bcrypt('admin123'),
                'created_at' => date('Y-m-d H:i:s'),

            ]

        ]);
        
    }
}
