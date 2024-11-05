<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'patient']);
        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'guest']);
        Role::create(['name' => 'insurance_company']);
        Role::create(['name' => 'drug_supplier']);
        Role::create(['name' => 'healthcare_provider']);

        // Create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view health info']);
        Permission::create(['name' => 'book appointment']);
        Permission::create(['name' => 'purchase insurance']);
        Permission::create(['name' => 'order medication']);
        Permission::create(['name' => 'track order']);
        Permission::create(['name' => 'view health news']);
        Permission::create(['name' => 'submit feedback']);
        Permission::create(['name' => 'update profile']);
        Permission::create(['name' => 'make payment']);
        Permission::create(['name' => 'manage health data']);
    }
}