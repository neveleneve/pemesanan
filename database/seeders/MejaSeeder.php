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
            Meja::create([
                'nama' => $nama,
                'token' => str_replace('-', '', $hash),
            ]);
        }
    }
}
