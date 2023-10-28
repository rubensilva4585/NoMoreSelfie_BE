<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'phone' => '123456789',
            'dob' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // User::factory()->count(50)->create();
    }
}
