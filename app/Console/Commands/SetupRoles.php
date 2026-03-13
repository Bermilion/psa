<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SetupRoles extends Command
{
    protected $signature = 'setup:roles';
    protected $description = 'Создаёт роли и права для MarineService Manager';

    public function handle()
    {
        // Создаём разрешения
        $permissions = [
            'manage reports',
            'view reports',
            'manage employees',
            'view employees',
            'manage customers',
            'view customers',
            'manage documents',
            'view documents',
            'send messages',
            'manage chats',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Администратор — все права
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo($permissions);

        // Менеджер — почти все
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $manager->givePermissionTo([
            'manage reports',
            'view reports',
            'manage employees',
            'view employees',
            'manage customers',
            'view customers',
            'manage documents',
            'view documents',
            'send messages',
            'manage chats',
        ]);

        // Сотрудник — только база
        $mechanic = Role::firstOrCreate(['name' => 'mechanic']);
        $mechanic->givePermissionTo([
            'view employees',      // только свою карточку
            'view documents',      // только чтение
            'send messages',       // в своих чатах
        ]);

        $this->info('Роли и права успешно настроены.');
    }
}
