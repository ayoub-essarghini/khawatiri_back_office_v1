<?php

namespace Database\Seeders;

use App\Models\Admin;
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
    public function run()
    {
        User::create([
            'fname' => 'Super ',
            'lname' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'is_admin'=>1,
            'password' => Hash::make('password'),
        ]);
        User::create([
            'fname' => 'Editor ',
            'lname' => 'edit',
            'email' => 'editor@gmail.com',
            'is_admin'=>0,
            'password' => Hash::make('password'),
        ]);
      
    }
}
