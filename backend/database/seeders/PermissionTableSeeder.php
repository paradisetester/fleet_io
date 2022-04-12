<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {		
		$this->call(PermissionSectionsTableSeeder::class);
		$this->call(PermissionModulesTableSeeder::class);
		$this->insertAllPermissions();
	}
	
	private function insertAllPermissions(){
		
		$inputData = [
			[
				'name' => 'Dashboard',
				'slug' => 'dashboard',
				'dependent_on_sections' => '',
				'module_id' => 1,
				'module_order' => 1,
				'section_id' => 28,
				'section_order'=> 28,
				'type' => 1,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Vehicle List',
				'slug' => 'vehicledetails',
				'dependent_on_sections' => '19,20,21,24,25,26,29',
				'module_id' => 2,
				'module_order' => 2,
				'section_id' => 1,
				'section_order'=> 1,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Vehicle Assignment',
				'slug' => 'vehicleAssignment',
				'dependent_on_sections' => '2,22',
				'module_id' => 2,
				'module_order' => 2,
				'section_id' => 2,
				'section_order'=> 2,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Meter History',
				'slug' => 'vehiclemeterhistory',
				'dependent_on_sections' => '2',
				'module_id' => 2,
				'module_order' => 2,
				'section_id' => 3,
				'section_order'=> 3,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Expense History',
				'slug' => 'vehicleexpensehistory',
				'dependent_on_sections' => '2,22',
				'module_id' => 2,
				'module_order' => 2,
				'section_id' => 4,
				'section_order'=> 4,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Inspection List',
				'slug' => 'vehicleInspection',
				'dependent_on_sections' => '',
				'module_id' => 3,
				'module_order' => 3,
				'section_id' => 5,
				'section_order'=> 1,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Inspection Forms',
				'slug' => 'inspectiontemplates',
				'dependent_on_sections' => '',
				'module_id' => 3,
				'module_order' => 3,
				'section_id' => 6,
				'section_order'=> 2,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Pages',
				'slug' => 'posts',
				'dependent_on_sections' => '',
				'module_id' => 4,
				'module_order' => 4,
				'section_id' => 7,
				'section_order'=> 1,
				'type' => 1,
				'for_only_admin' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Theme',
				'slug' => 'themesetting',
				'dependent_on_sections' => '',
				'module_id' => 4,
				'module_order' => 4,
				'section_id' => 8,
				'section_order'=> 2,
				'type' => 1,
				'for_only_admin' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Testimonials',
				'slug' => 'testimonials',
				'dependent_on_sections' => '',
				'module_id' => 4,
				'module_order' => 4,
				'section_id' => 9,
				'section_order'=> 3,
				'type' => 1,
				'for_only_admin' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Plans',
				'slug' => 'plans',
				'dependent_on_sections' => '',
				'module_id' => 4,
				'module_order' => 4,
				'section_id' => 10,
				'section_order'=> 4,
				'type' => 1,
				'for_only_admin' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Menu',
				'slug' => 'menus',
				'dependent_on_sections' => '',
				'module_id' => 4,
				'module_order' => 4,
				'section_id' => 11,
				'section_order'=> 5,
				'type' => 1,
				'for_only_admin' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Contact list',
				'slug' => 'contactus',
				'dependent_on_sections' => '',
				'module_id' => 4,
				'module_order' => 4,
				'section_id' => 12,
				'section_order'=> 6,
				'type' => 1,
				'for_only_admin' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Career form list',
				'slug' => 'career',
				'dependent_on_sections' => '',
				'module_id' => 4,
				'module_order' => 4,
				'section_id' => 13,
				'section_order'=> 7,
				'type' => 1,
				'for_only_admin' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Issues',
				'slug' => 'issue',
				'dependent_on_sections' => '2,29',
				'module_id' => 5,
				'module_order' => 5,
				'section_id' => 14,
				'section_order'=> 1,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Service Reminders',
				'slug' => 'service_reminder',
				'dependent_on_sections' => '2',
				'module_id' => 6,
				'module_order' => 6,
				'section_id' => 15,
				'section_order'=> 1,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Vehicle Renewal',
				'slug' => 'vehicle_renewal_reminder',
				'dependent_on_sections' => '2',
				'module_id' => 6,
				'module_order' => 6,
				'section_id' => 16,
				'section_order'=> 2,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Contact Renewal',
				'slug' => 'contact_renewal_reminder',
				'dependent_on_sections' => '',
				'module_id' => 6,
				'module_order' => 6,
				'section_id' => 17,
				'section_order'=> 3,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'services History',
				'slug' => 'servicehistory',
				'dependent_on_sections' => '2,22',
				'module_id' => 7,
				'module_order' => 7,
				'section_id' => 18,
				'section_order'=> 1,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'services Task',
				'slug' => 'servicetask',
				'dependent_on_sections' => '',
				'module_id' => 7,
				'module_order' => 7,
				'section_id' => 19,
				'section_order'=> 2,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'services program',
				'slug' => 'serviceprogram',
				'dependent_on_sections' => '',
				'module_id' => 7,
				'module_order' => 7,
				'section_id' => 20,
				'section_order'=> 3,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Vendor lists',
				'slug' => 'vendor',
				'dependent_on_sections' => '',
				'module_id' => 8,
				'module_order' => 8,
				'section_id' => 21,
				'section_order'=> 1,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Fuel lists',
				'slug' => 'fuel',
				'dependent_on_sections' => '2,22',
				'module_id' => 9,
				'module_order' => 9,
				'section_id' => 22,
				'section_order'=> 1,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Make lists',
				'slug' => 'vehiclemake',
				'dependent_on_sections' => '',
				'module_id' => 10,
				'module_order' => 10,
				'section_id' => 23,
				'section_order'=> 1,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Model lists',
				'slug' => 'vehiclemake',
				'dependent_on_sections' => '',
				'module_id' => 10,
				'module_order' => 10,
				'section_id' => 24,
				'section_order'=> 2,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Trim lists',
				'slug' => 'vehiclemodel',
				'dependent_on_sections' => '',
				'module_id' => 10,
				'module_order' => 10,
				'section_id' => 25,
				'section_order'=> 3,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Tenants List',
				'slug' => 'tenants',
				'dependent_on_sections' => '',
				'module_id' => 13,
				'module_order' => 11,
				'section_id' => 30,
				'section_order'=> 1,
				'type' => 1,
				'for_only_admin' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Orders List',
				'slug' => 'orders',
				'dependent_on_sections' => '',
				'module_id' => 14,
				'module_order' => 12,
				'section_id' => 31,
				'section_order'=> 1,
				'type' => 1,
				'for_only_admin' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'User lists',
				'slug' => 'users',
				'dependent_on_sections' => '',
				'module_id' => 11,
				'module_order' => 13,
				'section_id' => 26,
				'section_order'=> 1,
				'type' => 1,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'name' => 'Billing & Subscription',
				'slug' => 'accountSubscription',
				'dependent_on_sections' => '',
				'module_id' => 12,
				'module_order' => 14,
				'section_id' => 28,
				'section_order'=> 2,
				'type' => 0,
				'for_only_admin' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
			]
		];

		Permission::insert($inputData);
	}
}
