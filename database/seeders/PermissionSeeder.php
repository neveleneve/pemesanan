<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        if (Permission::count() > 0) {
            Permission::truncate();
        }

        $permissions = [
            'dashboard index',

            'user index',
            'user create',
            'user show',
            'user edit',
            'user delete',

            'menu index',
            'menu create',
            'menu show',
            'menu edit',
            'menu delete',

            'meja index',
            'meja create',
            'meja show',
            'meja edit',
            'meja delete',

            'transaksi index',
            'transaksi create',
            'transaksi show',
            'transaksi edit',
            'transaksi delete',
            'transaksi cetak',

            'pesanan index',
            'pesanan create',
            'pesanan show',
            'pesanan edit',
            'pesanan delete',

            'report index',
        ];

        $admin = [
            'dashboard index',

            'user index',
            'user create',
            'user show',
            'user edit',
            'user delete',

            'menu index',
            'menu create',
            'menu show',
            'menu edit',
            'menu delete',

            'meja index',
            'meja create',
            'meja show',
            'meja edit',
            'meja delete',

            'transaksi index',
            'transaksi create',
            'transaksi show',
            'transaksi edit',
            'transaksi delete',

            'pesanan index',
            'pesanan create',
            'pesanan show',
            'pesanan delete',

            'report index',
        ];
        $dapur = [
            'dashboard index',
            'menu index',
            'menu edit',
            'pesanan index',
            'pesanan edit',
        ];
        $kasir = [
            'dashboard index',
            'menu index',
            'meja index',
            'transaksi index',
            'transaksi show',
            'transaksi cetak',
            'pesanan index',
        ];
        for ($i = 0; $i < count($permissions); $i++) {
            Permission::create([
                'name' => $permissions[$i]
            ]);
        }

        $roletotal = Role::count();
        for ($i = 0; $i < $roletotal; $i++) {
            $role = Role::findById($i + 1);
            if ($i == 0) {
                $role->givePermissionTo($admin);
            } elseif ($i == 1) {
                $role->givePermissionTo($kasir);
            } elseif ($i == 2) {
                $role->givePermissionTo($dapur);
            }
        }
    }
}
