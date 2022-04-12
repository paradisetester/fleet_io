<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\PlanPermissions;


class CommonDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if(isset($_SERVER['argv']) && $_SERVER['argv'][1] == 'tenants:admin') {
            $this->createDummyThemeSettings();
            $this->createDummyPlans();
			$this->insertAllPlanPermissions();
            $this->createDummyPosts();
            $this->createDummyLinks();
            $this->createDummyUsers();
        }else{
            $this->createDummyVehicleMakes();
            $this->createDummyServicePrograms();
            $this->createDummyVehicleDetails();
            $this->createDummyInspectionTemplate();
            $this->createDummyInspectionTemplateItem();
            $this->createDummyVendors();
            $this->createDummyFuels();
            $this->createDummyTenanatUsers();
        }
    }


private function createDummyTenanatUsers(){
        DB::table('users')->insert([
            [
                'name' => 'Max',
                'email' => 'max@gmail.com',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => 0,
                'can_login' => 0,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Robert',
                'email' => 'robert@gmail.com',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => 0,
                'can_login' => 0,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('users_details')->insert([
            [
                'user_id' => '2',
                'mobile' => '9041571952',
                'image' => 0,
                'dob' => now(),
                'job_title' => 0,
                'employee' => 0,
                'operator' => 0,
                'address1' => 1,
                'address2' => 1,
                'city' => 1,
                'state' => 1,
                'postal_code' => 1,
                'country' => 1,
                'employee_number' => 1,
                'employee_join_at' => 1,
                'employee_leave_at' => 1,
                'operator_license_number' => 1,
                'operator_license_class' => 1,
                'operator_license_state' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '2',
                'mobile' => '9041571952',
                'image' => 0,
                'dob' => now(),
                'job_title' => 0,
                'employee' => 0,
                'operator' => 0,
                'address1' => 1,
                'address2' => 1,
                'city' => 1,
                'state' => 1,
                'postal_code' => 1,
                'country' => 1,
                'employee_number' => 1,
                'employee_join_at' => 1,
                'employee_leave_at' => 1,
                'operator_license_number' => 1,
                'operator_license_class' => 1,
                'operator_license_state' => 1,
                'created_at' => now(),
                'updated_at' => now()
        ]
    ]);
    }

    private function createDummyUsers(){
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => 1,
                'can_login' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Anju Batta',
                'email' => 'anjubatta@gmail.com',
                'password' => Hash::make('anjubatta'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => 0,
                'can_login' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Arun Parashar',
                'email' => 'arunprasher@gmail.com',
                'password' => Hash::make('arunprasher'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => 0,
                'can_login' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        $tenant_id = DB::table('tenants_mgmt')->insertGetId([
            'uid' => 'fleet_admin',
            'database_name' => 'fleet_admin',
            'tenant_email' => 'admin@gmail.com',
            'tenant_password' => Hash::make('admin'),
            'plan_id' => DB::table('plan_inventories')->where('heading', 'Standard')->first()->id,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tenants_user')->insert([
            [
                'tenant_id' => $tenant_id,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'user_type' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tenant_id' => $tenant_id,
                'email' => 'anjubatta@gmail.com',
                'password' => Hash::make('anjubatta'),
                'user_type' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tenant_id' => $tenant_id,
                'email' => 'arunprasher@gmail.com',
                'password' => Hash::make('arunprasher'),
                'user_type' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    private function createDummyThemeSettings(){
        DB::table('theme_settings')->insert([
            [
                'title' => 'admin',
                'footer' => 'This is footer',
                'header' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
                'phoneno' => '9041571952',
                'photo' => 'public/images/logo.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    private function createDummyVehicleMakes(){
        DB::table('vehicle_makes')->insert([
            [
                'name' => 'BMW',
                'description' => 'this is my First car',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Porshe',
                'description' => 'this is my Second car',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ford',
                'description' => 'this is my Third car',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        $idmake = DB::table('vehicle_makes')->insertGetId(
                [
                    'name' => 'Audi',
                    'description' => 'this is my Fourth car',
                    'status' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
        ]);
        DB::table('vehicle_models')->insert([
            [
                'name' => 'RS 7 SportBack',
                'make_id' => $idmake,
                'description' => 'this is my Secord car',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'A8L',
                'make_id' => $idmake,
                'description' => 'this is my Third car',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Q2',
                'make_id' => $idmake,
                'description' => 'this is my Fourth car',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'BMW X1',
                'make_id' => '1',
                'description' => 'this is my Fourth car',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Porsche Macan',
                'make_id' => '2',
                'description' => 'this is my Fourth car',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ford EcoSport',
                'make_id' => '3',
                'description' => 'this is my Fourth car',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);


        $idmodel = DB::table('vehicle_models')->insertGetId(
                [
                    'name' => 'A6 Sedan',
                    'description' => 'this is my Fifth car Model',
                    'status' => '1',
                    'make_id' => $idmake,
                    'created_at' => now(),
                    'updated_at' => now()
        ]);
        DB::table('vehicletypes')->insert([
            [
                'name' => 'A6 2.0T Premium',
                'model_id' => $idmodel,
                'description' => 'this is my first car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2019 A6 2.0T)',
                'model_id' => $idmodel,
                'description' => 'this is my Secord car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2019 A6)',
                'model_id' => $idmodel,
                'description' => 'this is my Third car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2018 A6)',
                'model_id' => $idmodel,
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'X1 sDrive 20i SportX',
                'model_id' => '4',
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Macan Base',
                'model_id' => '5',
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'EcoSport Trend 1.5L Ti-VCT',
                'model_id' => '6',
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'RS 7 Sportback Carbon Black',
                'model_id' => '1',
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'RS 7 Sportback Vorsprung',
                'model_id' => '1',
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sport',
                'model_id' => '2',
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'S line',
                'model_id' => '2',
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Technik',
                'model_id' => '3',
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sport 51',
                'model_id' => '3',
                'description' => 'this is my Fourth car Trim',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    private function createDummyServicePrograms(){
        DB::table('service_programs')->insert([
            [
                'name' => 'Service Program 1',
                'template' => 'Template 1',
                'photo' => 'public/images/uploads/2020/Nov/carservice.jpg',
                'primary_meter' => 'Primary Meter 1',
                'secondary_meter' => 'Secondary Meter 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Service Program 2',
                'template' => 'Template 2',
                'photo' => 'public/images/uploads/2020/Nov/carservice2.jpg',
                'primary_meter' => 'Primary Meter 2',
                'secondary_meter' => 'Secondary Meter 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Service Program 3',
                'template' => 'Template 3',
                'photo' => 'public/images/uploads/2020/Nov/carservice3.jpg',
                'primary_meter' => 'Primary Meter 3',
                'secondary_meter' => 'Secondary Meter 3',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    private function createDummyVehicleDetails(){
        DB::table('vehicle_details')->insert([
            [
                'name' => '1100 [2018 Toyota Prius]',
                'vin' => 'JTDKBRFU9J30593O7',
                'type' => 'Car',
                'license_plate' => '6TRJ244',
                'year' => '2020',
                'registration_state' => 'chandigarh',
                'registration_photo' => 'public/images/uploads/2020/Nov/2018_Toyota_Prius_2.jpg',
                'status' => 'outofservice',
                'group_id' => '1',
                'contact_id' => '1',
                'ownership' => 'Leased',
                'color' => '#7fd4a7',
                'body_type_id' => 'full-size',
                'body_sub_type_id' => 'Cargo',
                'msrp' => '24950',
                'purchase_price'=>'50000',
                'linked_vehicle_id' => '1',
                'make_id' => '4',
                'model_id' => '4',
                'trim_id' => '4',
                'service_program' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2100 [2016 Ford F-150]',
                'vin' => '1FTFW1EG3GFA3I822',
                'type' => 'Car',
                'license_plate' => '1CA7895',
                'year' => '2020',
                'registration_state' => 'chandigarh',
                'registration_photo' => 'public/images/uploads/2020/Nov/ford.jpeg',
                'status' => 'outofservice',
                'group_id' => '1',
                'contact_id' => '1',
                'ownership' => 'Rented',
                'color' => '#7fd4a7',
                'body_type_id' => 'full-size',
                'body_sub_type_id' => 'Cargo',
                'msrp' => '36455',
                'purchase_price'=>'50000',
                'linked_vehicle_id' => '1',
                'make_id' => '4',
                'model_id' => '4',
                'trim_id' => '4',
                'service_program' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '3100 [2014 Chevrolet Express Cargo]',
                'vin' => '1GCZGTCG7E11519I7',
                'type' => 'Car',
                'license_plate' => '1CA7898',
                'year' => '2020',
                'registration_state' => 'chandigarh',
                'registration_photo' => 'public/images/uploads/2020/Nov/chevrlet.jpeg',
                'status' => 'outofservice',
                'group_id' => '1',
                'contact_id' => '1',
                'ownership' => 'Customer',
                'color' => '#7fd4a7',
                'body_type_id' => 'full-size',
                'body_sub_type_id' => 'Cargo',
                'msrp' => '27710',
                'purchase_price'=>'50000',
                'linked_vehicle_id' => '1',
                'make_id' => '4',
                'model_id' => '4',
                'trim_id' => '4',
                'service_program' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    private function createDummyInspectionTemplate(){
        DB::table('inspection_templates')->insert([
            [
                'title' => 'Accident Report',
                'description' => 'As required by the US Dept. of Transportation (DOT) Federal Motor Carrier Safety Regulations in FMCSA 396.11.a.1',
                'selected_template' => '',
                'user_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Driver Vehicle Inspection Report (Simple)',
                'description' => 'As required by the US Dept. of Transportation (DOT) Federal Motor Carrier Safety Regulations in FMCSA 396.11.a.1',
                'selected_template' => '',
                'user_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Covid - 19 Post-Trip Vehicle Disinfection',
                'description' => 'Covid - 19 Post-Trip Vehicle Disinfection',
                'selected_template' => '',
                'user_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Trailer inspection',
                'description' => 'This is trailer for inspection.',
                'selected_template' => '',
                'user_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    private function createDummyInspectionTemplateItem(){
        DB::table('inspection_template_items')->insert([
            [
                'fields' => '[{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Horn","itemRequired":false,"itemShortDescription":"","itemInstructions":"","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true},{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Engine","itemRequired":true,"itemShortDescription":"Engine","itemInstructions":"Engine is not working properly.","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true},{"itemName":"Number","itemID":"number","itemLabel":"Oil life left.","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemPassingRangeMin":"","itemPassingRangeMax":""},{"itemName":"Photo","itemID":"photo","itemLabel":"Interior Cleanliness","itemRequired":true,"itemDescription":"","itemInstructions":"","itemShortDescription":"Take a photo of the interior."},{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Clutch","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true},{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Rear Vision Mirrors","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true},{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Tires","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true},{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Wheels and Rims","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true},{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Emergency Equipment","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true}]',
                'inspection_template_id' => '1',
                'user_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'fields' => '[{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Engine","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true},{"itemName":"Meter Entry","itemID":"meterentery","itemLabel":"Odometer Reading","itemRequired":true,"itemDescription":"","itemRequiredSecondaryMeter":false,"itemRequiredPhotoVerification":true},{"itemName":"Dropdown","itemID":"dropdown","itemLabel":"Vehicle condition OK","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemChoices":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true},{"itemName":"Signature","itemID":"signature","itemLabel":"Reviewing Driver Signature","itemRequired":true,"itemDescription":""}]',
                'inspection_template_id' => '2',
                'user_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'fields' => '[{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Engine","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true},{"itemName":"Meter Entry","itemID":"meterentery","itemLabel":"Odometer Reading","itemRequired":false,"itemDescription":"","itemRequiredSecondaryMeter":false,"itemRequiredPhotoVerification":false},{"itemName":"Pass/Fail","itemID":"passfail","itemLabel":"Windshield and Wipers/Washers","itemRequired":true,"itemShortDescription":"","itemInstructions":"","itemPassLabel":"Pass","itemFailLabel":"Fail","itemEnableNA":false,"itemEnableNALabel":"","itemRequiredPhotoCommentForPass":false,"itemRequiredPhotoCommentForFail":true}]',
                'inspection_template_id' => '2',
                'user_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
}
        

    private function createDummyVendors(){
        DB::table('vendors')->insert([
            [
                'user_id' => '1',
                'name' => 'Chevron',
                'phone' => '205-323-7282',
                'website' => 'http://www.mavistire.com',
                'labels' => '1',
                'address' => 'Birmingham, AL',
                'address_line_2' => '3200 6th Ave S, Birmingham, AL 35222, US',
                'city' => 'AL',
                'state' => 'Birmingham, AL',
                'postal_code' => '3545435',
                'country' => 'USA',
                'contact_name' => 'Jose Valdespino',
                'contact_email' => 'Jose@gmail.com',
                'contact_phone' => '205-323-7282',
                'fuel' => '1',
                'service' => '1',
                'vehicle' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    private function createDummyFuels(){
        
        DB::table('fuels')->insert([
            [
                'vehicle_id' => '1',
                'user_id' => '2',
                'date' => '2020-10-01',
                'time' => '15:33:59',
                'odometer' => '111',
                'price' => '1200.00',
                'fuel_type' => 'Diesel',
                'vendor_id' => '1',
                'reference' => '111',
                'personal' => '11',
                'partial_fuel_up' => '111',
                'photo' => 'public/images/uploads/2020/Nov/fuel.jpg',
                'document' => 'public/images/uploads/2020/Nov/fuel.jpg',
                'comment' => '111dsdsdsd',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'vehicle_id' => '2',
                'user_id' => '2',
                'date' => '2020-10-21',
                'time' => '15:33:59',
                'odometer' => '111',
                'price' => '10000.00',
                'fuel_type' => 'Diesel',
                'vendor_id' => '1',
                'reference' => '121',
                'personal' => '9',
                'partial_fuel_up' => '111',
                'photo' => 'public/images/uploads/2020/Nov/fuel1.jpeg',
                'document' => 'public/images/uploads/2020/Nov/fuel1.jpeg',
                'comment' => '111dsdsdsd',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'vehicle_id' => '3',
                'user_id' => '2',
                'date' => '2020-12-01',
                'time' => '18:33:59',
                'odometer' => '451',
                'price' => '11500.00',
                'fuel_type' => 'Diesel',
                'vendor_id' => '1',
                'reference' => '111',
                'personal' => '11',
                'partial_fuel_up' => '111',
                'photo' => 'public/images/uploads/2020/Nov/fuel1.jpeg',
                'document' => 'public/images/uploads/2020/Nov/fuel1.jpeg',
                'comment' => '111dsdsdsd',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    private function createDummyPosts(){
        DB::table('posts')->insert([
            [
                'user_id' => '1',
                'title' => 'About Us',
                'heading' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
                'slug' => 'about-us',
                'status' => 'publish',
                'image' => 'public/images/uploads/2020/Nov/How-to-Make-a-Car-Website.jpg',
                'description' => '<p><span style="color: rgb(113, 128, 150);">Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.</span></p>',
                'short_description' => 'Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.',
                'meta_title' => 'About Us',
                'meta_description' => 'About Us Fleetio page',
                'type' => 'page',
                'template' => 'aboutUs',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'title' => 'Plans',
                'heading' => 'Eliminate the cost of downtime.',
                'slug' => 'plans',
                'status' => 'publish',
                'image' => 'public/images/uploads/2020/Nov/1606486219_How-to-Make-a-Car-Website.jpg',
                'description' => '<p>For fleets that outsource all maintenance and repairs to external shops</p>',
                'short_description' => '14-day free trial. Simple, scalable pricing. No credit card required.',
                'meta_title' => 'Plans',
                'meta_description' => 'For fleets that outsource all maintenance and repairs to external shops',
                'type' => 'page',
                'template' => 'plans',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'title' => 'Contact Us',
                'heading' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
                'slug' => 'contact-us',
                'status' => 'publish',
                'image' => 'public/images/uploads/2020/Nov/1606486219_How-to-Make-a-Car-Website.jpg',
                'description' => '<p><span style="color: rgb(113, 128, 150);">Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.</span></p>',
                'short_description' => 'Vehicles and other records labeled as Sample are available to help you explore how Fleetio works during your trial.',
                'meta_title' => 'Test',
                'meta_description' => 'Contact us',
                'type' => 'page',
                'template' => 'contactUs',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'title' => 'Career',
                'heading' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
                'slug' => 'Career',
                'status' => 'publish',
                'image' => 'public/images/uploads/2020/Nov/1606486219_How-to-Make-a-Car-Website.jpg',
                'description' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>',
                'short_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
                'meta_title' => 'Career',
                'meta_description' => 'Career',
                'type' => 'page',
                'template' => 'career',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'title' => 'Checkout',
                'heading' => 'For fleets that outsource all maintenance and repairs to external shops',
                'slug' => 'checkout',
                'status' => 'publish',
                'image' => 'public/images/uploads/2020/Nov/checkout.jpg',
                'description' => '<p>Eliminate the cost of downtime.</p>',
                'short_description' => 'Eliminate the cost of downtime.',
                'meta_title' => 'checkout',
                'meta_description' => 'checkout',
                'type' => 'page',
                'template' => 'checkout',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'title' => 'Testimonials 1',
                'heading' => 'Admin',
                'slug' => 'testimonials-1',
                'status' => 'publish',
                'image' => 'public/images/uploads/2020/Oct/Testomonial1.svg',
                'description' => 'Testimonials test',
                'short_description' => 'test',
                'meta_title' => 'Testimonials 1',
                'meta_description' => 'Testimonials 1',
                'type' => 'testimonial',
                'template' => 'default',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => '1',
                'title' => 'Testimonial 2',
                'heading' => 'Admin',
                'slug' => 'testimonial-2',
                'status' => 'publish',
                'image' => 'public/images/uploads/2020/Oct/Testomonials.svg',
                'description' => 'Testimonial test',
                'short_description' => 'Admin ttest',
                'meta_title' => 'Testimonial 2',
                'meta_description' => 'Testimonial 2',
                'type' => 'testimonial',
                'template' => 'default',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    private function createDummyPlans(){
        DB::table('plan_inventories')->insert([
            [
                'heading' => 'Standard',
                'description' => '14 Days Free Trail',
                'features' => '',
                'discount' => '0.00',
                'free_trial' => '1',
                'status' => '2',
                'type' => '1',
                'price' => '10.99',
                'color' => 'green',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'heading' => 'Premium',
                'description' => '14 Days Free',
                'features' => '',
                'discount' => '0.00',
                'free_trial' => '1',
                'status' => '2',
                'type' => '1',
                'price' => '20.99',
                'color' => 'blue',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'heading' => 'Advance',
                'description' => '15 Days Free',
                'features' => '',
                'discount' => '0.00',
                'free_trial' => '1',
                'status' => '2',
                'type' => '1',
                'price' => '30.99',
                'color' => 'pink',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    private function createDummyLinks(){
        DB::table('links')->insert([
            [
                'link_url' => 'about-us',
                'link_name' => 'About Us',
                'post_id' => '1',
                'link_order' => '0',
                'link_parent' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'link_url' => 'plans',
                'link_name' => 'Plans',
                'post_id' => '2',
                'link_order' => '1',
                'link_parent' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'link_url' => 'contact-us',
                'link_name' => 'Contact Us',
                'post_id' => '3',
                'link_order' => '2',
                'link_parent' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'link_url' => 'Career',
                'link_name' => 'Career',
                'post_id' => '4',
                'link_order' => '3',
                'link_parent' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

	private function insertAllPlanPermissions(){
		$inputData = [
			[
				'plan_id' => 1,
				'permission_id' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 1,
				'permission_id' => 2,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 1,
				'permission_id' => 24,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 1,
				'permission_id' => 25,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 1,
				'permission_id' => 26,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 1,
				'permission_id' => 29,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 1,
				'permission_id' => 30,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 2,
				'permission_id' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 2,
				'permission_id' => 2,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 2,
				'permission_id' => 5,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 2,
				'permission_id' => 22,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 2,
				'permission_id' => 24,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 2,
				'permission_id' => 25,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 2,
				'permission_id' => 26,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 2,
				'permission_id' => 29,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 2,
				'permission_id' => 30,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 2,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 3,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 4,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 5,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 6,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 7,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 15,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 16,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 17,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 18,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 19,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 20,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 21,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 22,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 23,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 24,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 25,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 26,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 29,
                'created_at'=> now(),
                'updated_at'=> now()
			],
			[
				'plan_id' => 3,
				'permission_id' => 30,
                'created_at'=> now(),
                'updated_at'=> now()
			]

		];
		PlanPermissions::insert($inputData);
	}

}
