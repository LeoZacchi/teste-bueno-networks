<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            'name' => 'Usuário de Teste',
            'email' => 'teste@example.com',
            'password' => Hash::make('12345678'),
        ];

        $userId = DB::table('users')->insertGetId($user);

        // Criação das roles
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Common'],
        ];

        DB::table('roles')->insert($roles);

        // Atribuição da role 'Admin' ao usuário de teste
        $adminRoleId = DB::table('roles')->where('name', 'Admin')->value('id');

        DB::table('role_user')->insert([
            'role_id' => $adminRoleId,
            'user_id' => $userId,
        ]);
    }
}
