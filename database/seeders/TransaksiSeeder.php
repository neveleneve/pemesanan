<?php

namespace Database\Seeders;

use App\Models\Meja;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meja = Meja::count();

        $gender = ['male', 'female'];

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $pickmeja = rand(1, $meja);
            Transaksi::create([
                'meja_id' => $pickmeja,
                'nama' => $faker->name($gender[rand(0, 1)]),
                'kode' => Random::generate(10, '0-9a-zA-Z'),
                'total' => rand(100000, 1000000),
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s', strtotime('-' . $i + 10 . 'minutes')),
            ]);
        }
    }
}
