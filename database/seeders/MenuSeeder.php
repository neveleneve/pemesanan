<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipe = ['makanan', 'minuman'];

        $harga = [
            5000,
            10000,
            15000,
            20000,
            25000,
            30000,
            35000,
            40000,
        ];

        for ($i = 0; $i < 25; $i++) {
            Menu::create([
                'nama' => 'Menu ' . $i + 1,
                'harga' => $harga[rand(0, 7)],
                'tipe' => $tipe[rand(0, 1)],
                'status' => rand(0, 1),
            ]);
        }
    }
}
