<?php

namespace Database\Seeders;

use App\Models\Meja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 11; $i++) {
            $nama = 'Meja ' . $i + 1;
            $hash = uuid_generate_sha1(uuid_create(UUID_TYPE_NAME), $nama);
            if ($i == 0) {
                Meja::create([
                    'nama' => $nama,
                    'token' => '4ef9eed4716353ccbbd16cfcf53ce333',
                ]);
            } else {
                Meja::create([
                    'nama' => $nama,
                    'token' => str_replace('-', '', $hash),
                ]);
            }
        }
    }
}
