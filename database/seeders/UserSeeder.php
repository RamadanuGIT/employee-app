<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = [
            [
                'name' => 'user',
                'email' => 'user1@example.com',
                'password' => bcrypt('123'),
            ],
            [
                'name' => 'user',
                'email'=> 'user2@example.com',
                'password'=> bcrypt('123'),
            ]
        ];
        DB::table('users')->insert($user);
    }
}
