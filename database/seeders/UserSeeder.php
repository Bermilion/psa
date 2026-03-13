<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::query()->delete();

        $admin = User::create([
            'name' => 'Администратор',
            'email' => 'admin@marine.local',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        $manager = User::create([
            'name' => 'Менеджер',
            'email' => 'manager@marine.local',
            'password' => Hash::make('password'),
        ]);
        $manager->assignRole('manager');

        $mechanic = User::create([
            'name' => 'Иван Слесарь',
            'email' => 'mechanic@marine.local',
            'password' => Hash::make('password'),
        ]);
        $mechanic->assignRole('mechanic');
    }
}
