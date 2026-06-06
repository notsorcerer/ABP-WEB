<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin LiquidPedia',
            'email' => 'admin@liquidpedia.id',
            'password' => 'admin123',
            'is_admin' => true,
        ]);
    }
}
