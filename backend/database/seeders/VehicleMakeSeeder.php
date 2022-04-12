<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VehicleMakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_makes')->insert([
    	
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
