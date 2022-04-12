<?php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserWithPermissionAndRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $dev_role = Role::where('slug','developer')->first();
	    $manager_role = Role::where('slug', 'manager')->first();
	    $dev_perm = Permission::where('slug','create-tasks')->first();
	    $manager_perm = Permission::where('slug','edit-tasks')->first();

	    $developer = new User();
	    $developer->name = 'Usama Muneer';
	    $developer->email = 'usama@thewebtier.com';
	    $developer->password = bcrypt('secret');
            $developer->remember_token = Str::random(10);
            $developer->created_at = now();
            $developer->updated_at = now();
	    $developer->save();
	    $developer->roles()->attach($dev_role);
	    $developer->permissions()->attach($dev_perm);


	    $manager = new User();
	    $manager->name = 'Manager';
	    $manager->email = 'arunprasher1@gmail.com';
	    $manager->password = bcrypt('secret');
            $manager->remember_token = Str::random(10);
            $manager->created_at = now();
            $manager->updated_at = now();
	    $manager->save();
	    $manager->roles()->attach($manager_role);
	    $manager->permissions()->attach($manager_perm);
            
    }
}
