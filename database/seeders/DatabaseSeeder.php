<?php

namespace Database\Seeders;

use App\Models\User;
use GuzzleHttp\Client;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {


            User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'093423423',
            'gender'=>'male',
            'role'=>'admin',
            'address'=>'Yangon',
            'password'=>Hash::make('thz123456')
        ]);

    }
}
