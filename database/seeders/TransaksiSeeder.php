<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class TransaksiSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = \Faker\Factory::create('ID_id');

        $gender = ['male', 'female'];

        $menu = Menu::where('status', 1)->get(['id', 'harga']);
        $jmlMenu = count($menu);

        $meja = Meja::count();

        for ($i = 0; $i < 1; $i++) {
            $pickmeja = rand(1, $meja);
            $date = date('Y-m-d H:i:s', strtotime('-' . $i . 'minutes'));
            $transaksi = Transaksi::create([
                'meja_id' => $pickmeja,
                'nama' => $faker->name($gender[rand(0, 1)]),
                'kode' => Random::generate(10, '0-9a-zA-Z'),
                'total' => 0,
                'created_at' => $date,
            ]);

            for ($j = 0; $j < rand(2, 4); $j++) {
                $randMenu = rand(0, $jmlMenu - 1);
                $menudata = [
                    'id' => $menu[$randMenu]->id,
                    'harga' => $menu[$randMenu]->harga,
                ];
                $qty = rand(1, 3);
                $subtotal = $qty * $menudata['harga'];
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'menu_id' => $menudata['id'],
                    'harga' => $menudata['harga'],
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                    'status' => 0,
                    'created_at' => $date,
                ]);
                $transaksi->increment('total', $subtotal);
            }
        }
    }
}
