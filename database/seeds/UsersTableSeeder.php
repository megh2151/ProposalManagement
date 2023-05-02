<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
               'name'=>'admin',
               'email'=>'admin@gmail.com',
               'role_id'=>'1',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'user',
               'email'=>'user@gmail.com',
               'role_id'=>'0',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'government',
               'email'=>'government@yoursite.com',
                'role_id'=>'2',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}