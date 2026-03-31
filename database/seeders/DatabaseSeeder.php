<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Super Admin', 'Admin', 'Campaign Manager', 'Viewer'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        foreach (['manage users', 'manage campaigns', 'view reports', 'manage settings'] as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        Role::findByName('Super Admin')->syncPermissions(Permission::all());
        Role::findByName('Admin')->syncPermissions(['manage campaigns', 'view reports', 'manage settings']);
        Role::findByName('Campaign Manager')->syncPermissions(['manage campaigns', 'view reports']);
        Role::findByName('Viewer')->syncPermissions(['view reports']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('Password@123')]
        );
        $admin->assignRole('Super Admin');

        Contact::factory()->count(50)->create();
        EmailTemplate::factory()->count(5)->create(['created_by' => $admin->id]);
        Campaign::factory()->count(10)->create(['created_by' => $admin->id]);
    }
}
