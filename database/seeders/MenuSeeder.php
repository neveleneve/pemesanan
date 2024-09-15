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
        $menu = [
            [
                'nama' => 'Nasi Putih',
                'images' => 'Nasi_Putih-1722882255.jpg',
                'harga' => 4000,
                'estimasi_waktu' => 1,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Nasi Goreng',
                'images' => 'Nasi_Goreng-1722910338.jpg',
                'harga' => 12000,
                'estimasi_waktu' => 5,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Teh Obeng',
                'images' => 'Teh_Obeng-1722913962.png',
                'harga' => 6000,
                'estimasi_waktu' => 3,
                'tipe' => 'minuman',
                'status' => '1',
            ],
            [
                'nama' => 'Mie Goreng',
                'images' => 'Mie_Goreng-1722914203.png',
                'harga' => 12000,
                'estimasi_waktu' => 8,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Ayam Goreng',
                'images' => 'Ayam_Goreng-1722914608.jpg',
                'harga' => 13000,
                'estimasi_waktu' => 6,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Kentang Goreng',
                'images' => 'Kentang_Goreng-1722914647.jpg',
                'harga' => 12000,
                'estimasi_waktu' => 6,
                'tipe' => 'makanan',
                'status' => '1',
            ],
            [
                'nama' => 'Es Jeruk',
                'images' => 'Es_Jeruk-1722914683.jpg',
                'harga' => 8000,
                'estimasi_waktu' => 3,
                'tipe' => 'minuman',
                'status' => '1',
            ],
            [
                'nama' => 'Kopi Susu',
                'images' => 'Kopi_Susu-1722914710.jpg',
                'harga' => 7000,
                'estimasi_waktu' => 2,
                'tipe' => 'minuman',
                'status' => '1',
            ],
            [
                'nama' => 'Kopi Hitam',
                'images' => 'Kopi_Hitam-1722990806.jpg',
                'harga' => 5000,
                'tipe' => 'minuman',
                'estimasi_waktu' => 2,
                'status' => '1',
            ],
            [
                'nama' => 'Air Putih',
                'images' => 'Air_Putih-1722991005.jpg',
                'harga' => 2000,
                'estimasi_waktu' => 1,
                'tipe' => 'minuman',
                'status' => '1',
            ],
            [
                'nama' => 'Milo Susu',
                'images' => 'Milo_Susu-1722991093.jpg',
                'harga' => 9000,
                'estimasi_waktu' => 4,
                'tipe' => 'minuman',
                'status' => '1',
            ],
        ];


        for ($i = 0; $i < 11; $i++) {
            Menu::create([
                'nama' => $menu[$i]['nama'],
                'images' => $menu[$i]['images'],
                'harga' => $menu[$i]['harga'],
                'estimasi_waktu' => $menu[$i]['estimasi_waktu'],
                'tipe' => $menu[$i]['tipe'],
                'status' => $menu[$i]['status'],
            ]);
        }
    }
}
