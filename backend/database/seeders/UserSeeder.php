<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Permission;
use App\Models\SiteDetails;
use App\Models\User;
use App\Models\V1\VehicleMake;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(array $data = [])
    {               
        if(!empty($data)){
            $this->call(PermissionSectionsTableSeeder::class);
            $this->call(PermissionModulesTableSeeder::class);
            $this->newSiteDatabaseSetting($data);
            $this->call(DatabaseSeeder::class);
        }else{
            $this->createDummyMultipleUsers();
            $this->createDummyVehicleMakes();
        }
    }

    private function newSiteDatabaseSetting($data){
        $userData = $data['user'];
        $permissions = $data['permissions'];
        $tenant_data = $data['tenant_data'];
        if(!empty($userData['name']) && !empty($userData['email']) && !empty($userData['password'])){
            $user = new User();
            $user->name =  $userData['name'];
            $user->email =  $userData['email'];
            $user->password =  Hash::make($userData['password']);
            $user->is_admin =  1;
            $user->can_login =  1;
            $user->email_verified_at =  now();
            $user->remember_token =  Str::random(10);
            $user->save();
        }
        if(!empty($permissions)){
		    Permission::insert($permissions);
        }
        if(!empty($tenant_data)){
		    SiteDetails::create($tenant_data);
        }
    }

    private function createDummyMultipleUsers(){
        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => 1,
                'can_login' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Anju Batta',
                'email' => 'anjubatta@gmail.com',
                'password' => Hash::make('anjubatta'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => 0,
                'can_login' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Arun Parashar',
                'email' => 'arunprasher@gmail.com',
                'password' => Hash::make('arunprasher'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => 0,
                'can_login' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
            ]
        ]);
    }
    
    private function createDummyVehicleMakes(){
        VehicleMake::insert([
            [
                'name' => 'BMW',
                'description' => 'this is my Secord car',
                'status' => '1',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Porshe',
                'description' => 'this is my Third car',
                'status' => '1',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name' => 'Ford',
                'description' => 'this is my Fourth car',
                'status' => '1',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
        ]);
    }
}
