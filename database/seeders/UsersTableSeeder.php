<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'first_name' => 'Admin',
            'last_name' => 'Portal',
            'address_1' => '123 Street',
            'address_2' => 'West',
            'city' => 'Toronto',
            'state' => 'ON',
            'postal_code' => 'M2N4A2',
            'country' => 'CA',
            'email' => 'test@test.ca',
            'password' =>  Hash::make('test'),
        ]);
    }
}
