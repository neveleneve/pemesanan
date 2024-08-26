<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class MenuSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));

        $menu = [
            [
                'nama' => 'Nasi Putih',
                'images' => 'Nasi_Putih-1722882255.jpg',
                'harga' => 4000,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Nasi Goreng',
                'images' => 'Nasi_Goreng-1722910338.jpg',
                'harga' => 12000,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Teh Obeng',
                'images' => 'Teh_Obeng-1722913962.png',
                'harga' => 6000,
                'tipe' => 'minuman',
                'status' => '1',
            ],
            [
                'nama' => 'Mie Goreng',
                'images' => 'Mie_Goreng-1722914203.png',
                'harga' => 12000,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Ayam Goreng',
                'images' => 'Ayam_Goreng-1722914608.jpg',
                'harga' => 13000,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Kentang Goreng',
                'images' => 'Kentang_Goreng-1722914647.jpg',
                'harga' => 12000,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Es Jeruk',
                'images' => 'Es_Jeruk-1722914683.jpg',
                'harga' => 8000,
                'tipe' => 'minuman',
                'status' => '1',
            ],
            [
                'nama' => 'Kopi Susu',
                'images' => 'Kopi_Susu-1722914710.jpg',
                'harga' => 7000,
                'tipe' => 'minuman',
                'status' => '1',
            ],
            [
                'nama' => 'Kopi Hitam',
                'images' => 'Kopi_Hitam-1722990806.jpg',
                'harga' => 5000,
                'tipe' => 'minuman',
                'status' => '1',
            ],
            [
                'nama' => 'Air Putih',
                'images' => 'Air_Putih-1722991005.jpg',
                'harga' => 2000,
                'tipe' => 'minuman',
                'status' => '1',
            ],
            [
                'nama' => 'Milo Susu',
                'images' => 'Milo_Susu-1722991093.jpg',
                'harga' => 9000,
                'tipe' => 'minuman',
                'status' => '1',
            ],
        ];


        for ($i = 0; $i < 11; $i++) {
            $jenis =  rand(0, 1);
            if ($jenis) {
                $nama = $faker->beverageName();
            } else {
                $nama = $faker->foodName();
            }
            Menu::create([
                'nama' => $menu[$i]['nama'],
                'images' => $menu[$i]['images'],
                'harga' => $menu[$i]['harga'],
                'tipe' => $menu[$i]['tipe'],
                'status' => $menu[$i]['status'],
            ]);
        }
    }
}
