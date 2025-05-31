<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jasa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            "name" => "gdsgds",
            "email" => "arfan@gmail.com",
            "password" => bcrypt("12345"),
        ]);

        Jasa::create([
            "name" => "fsafsaf",
            "skill" => "vsvas",
            "price" => "54",
            "description" => "Fsafasf",
        ]);

        Jasa::create([
            "name" => "fsafsaf 1",
            "skill" => "vsvas 1",
            "price" => "54 1",
            "description" => "Fsafasf 1",
        ]);

        Jasa::create([
            "name" => "fsafsaf 2",
            "skill" => "vsvas 2",
            "price" => "54 2",
            "description" => "Fsafasf 2",
        ]);

        Jasa::create([
            "name" => "fsafsaf3 ",
            "skill" => "vsvas 2",
            "price" => "54 2",
            "description" => "Fsafasf 3",
        ]);

        
        Jasa::create([
            "name" => "fsafsaf 0000000000000000000 ",
            "skill" => "vsvas 2",
            "price" => "54 2",
            "description" => "Fsafasf 3",
        ]);
        
    }
}
