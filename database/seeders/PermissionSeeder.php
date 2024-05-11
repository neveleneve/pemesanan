<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard index',

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
                $role->givePermissionTo(Permission::all());
            } else {
                $role->givePermissionTo('dashboard index');
            }
        }
    }
}
