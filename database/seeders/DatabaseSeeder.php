<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        \App\Models\User::create([
            'user'=>'lentrix',
            'password'=>bcrypt('password123'),
            'email'=>'benjielenteria@mdc.ph',
            'email_verified_at'=>now(),
            'role' => 'admin'
        ]);
    }
}
