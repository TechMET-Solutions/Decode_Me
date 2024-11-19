<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SchoolDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // SchoolDetail::create([
        //     'school_name' => 'Janata',
        //     'school_code' => 'Janata123',
        //     'school_email' => 'user@gmail.com',
        //     'school_contact' => '8888221323',
        //     'school_place' => '8888221323',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'mobile' => '8888221323',
            'role' => 'admin'
        ]);
        // User::create([
        //     'name' => 'Rakesh',
        //     'email' => 'rakesh@gmail.com',
        //     'password' => Hash::make('rakesh123'),
        //     'mobile' => '8888221323',
        //     'school_id' => '1',
        //     'role' => 'user'
        // ]);
    }
}
