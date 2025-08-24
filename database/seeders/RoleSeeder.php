<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Administrador del sistema'],
            ['name' => 'pyme', 'description' => 'Usuario pyme'],
            ['name' => 'client', 'description' => 'Cliente final'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
