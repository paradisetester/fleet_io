<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionModules;

class PermissionModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputData = [
            [
                'name' => 'Dashboard',
                'url' => '/home',
                'slug' => 'home',
                'icon' => 'HomeIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Vehicles',
                'url' => null,
                'slug' => null,
                'icon' => 'HomeIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Inspections',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Website Management',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Issues',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Reminders',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Service',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Vendor',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Fuel',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Master Enteries',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Contacts & Users',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'User Settings',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Tenants',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Orders',
                'url' => null,
                'slug' => null,
                'icon' => 'UserIcon',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
        ];

        PermissionModules::insert($inputData);
    }
}
