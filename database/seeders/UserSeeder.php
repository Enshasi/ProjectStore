<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash ;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create([
            'name' => 'Administrator',
            'email' => 'abd@gmail.com',
            'password'=>Hash::make('12345678') ,
            'phone_number'=> '0598259628'

        ]);
    }
}
