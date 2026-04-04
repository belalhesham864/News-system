<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name'=>'Belal Hesham',
        'email'=>'belal@gmail.com',
        'username'=>'belal',
        'password'=>bcrypt(123456),
        ]);
    }
}
