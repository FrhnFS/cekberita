<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@diskominfo.jabar.go.id'],
            [
                'name' => 'Admin Diskominfo',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
