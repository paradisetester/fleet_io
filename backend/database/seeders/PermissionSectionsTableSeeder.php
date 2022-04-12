<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionSections;

class PermissionSectionsTableSeeder extends Seeder
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
                'name' => 'Vehicle List',
                'url' => '/vehicle',
                'slug' => 'vehicle-list',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Vehicle Assignment',
                'url' => '/vehicle/assignment',
                'slug' => 'vehicle-assignment',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Meter History',
                'url' => '/meter',
                'slug' => 'meter-history',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Expense History',
                'url' => '/expense',
                'slug' => 'expense-history',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Inspection List',
                'url' => '/inspection',
                'slug' => 'inspection-list',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Inspection Forms',
                'url' => '/inspection/forms',
                'slug' => 'inspection-forms',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Pages',
                'url' => '/pages',
                'slug' => 'pages',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Theme',
                'url' => '/theme',
                'slug' => 'theme',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Testimonials',
                'url' => '/testimonials',
                'slug' => 'testimonials',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Plans',
                'url' => '/plan',
                'slug' => 'plan',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Menu',
                'url' => '/menu',
                'slug' => 'menu',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Contact List',
                'url' => '/contactlist',
                'slug' => 'contactlist',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Career Form List',
                'url' => '/careerformlist',
                'slug' => 'careerformlist',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Issues',
                'url' => '/issues',
                'slug' => 'issues-list',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Service Reminders',
                'url' => '/service/reminders',
                'slug' => 'reminders-list',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Vehicle Renewal',
                'url' => '/vehicle/renewal',
                'slug' => 'vehicle-renewal',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Contact Renewal',
                'url' => '/contact/renewal',
                'slug' => 'contact-renewal',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Service History',
                'url' => '/services/history',
                'slug' => 'services-history',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Service Task',
                'url' => '/services/task',
                'slug' => 'services-task',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Service Program',
                'url' => '/services/program',
                'slug' => 'services-program',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Vendor Listing',
                'url' => '/vendor/lists',
                'slug' => 'vendor-lists',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Fuel Listing',
                'url' => '/Fuel/lists',
                'slug' => 'Fuel-lists',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Make Lists',
                'url' => '/Make',
                'slug' => 'Make-lists',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Model Lists',
                'url' => '/Model',
                'slug' => 'Model-lists',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Trim Lists',
                'url' => '/Type',
                'slug' => 'Trim-lists',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Users List',
                'url' => '/users',
                'slug' => 'users-list',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Users Settings',
                'url' => '/UsersSettings',
                'slug' => 'Users-Settings',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Billing & Subscription',
                'url' => '/account/subscription',
                'slug' => 'account-Settings',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Dashboard',
                'url' => null,
                'slug' => null,
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Tenants List',
                'url' => '/tenants',
                'slug' => 'tenants-list',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Orders List',
                'url' => '/orders',
                'slug' => 'orders-list',
                'icon' => null,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
        ];

        PermissionSections::insert($inputData);
    }
}
