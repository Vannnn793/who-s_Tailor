<?php

namespace Database\Seeders;

use App\Models\Jasa;
use Illuminate\Database\Seeder;

class JasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
