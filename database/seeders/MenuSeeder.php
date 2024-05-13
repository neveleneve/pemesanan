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
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));

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

        for ($i = 0; $i < 11; $i++) {
            $jenis =  rand(0, 1);
            if ($jenis) {
                $nama = $faker->beverageName();
            } else {
                $nama = $faker->foodName();
            }
            Menu::create([
                'nama' => $nama,
                'harga' => $harga[rand(0, 7)],
                'tipe' => $tipe[$jenis],
                'status' => rand(0, 1),
            ]);
        }
    }
}
