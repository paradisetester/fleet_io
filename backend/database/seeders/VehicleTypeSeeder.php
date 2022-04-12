<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$id = DB::table('vehicle_models')->insertGetId(
    	[
            'name' => 'A6 Sedan',
            'description' => 'this is my first car Model',
            'status' => '1',
            'make_id'=>'4',
            'created_at'=> now(),
            'updated_at'=> now()
        ]);
        DB::table('vehicletypes')->insert([
        [
            'name' => 'A6 2.0T Premium 4dr Sedan (2.0L 4cyl Turbo CVT)',
            'model_id'=>$id,
            'description' => 'this is my first car Trim',
            'status' => '1',
            'created_at'=> now(),
            'updated_at'=> now()
        ],
    	[
            'name' => '2019 A6 2.0T Premium Plus 4dr Sedan (2.0L 4cyl Turbo CVT)',
            'model_id'=>$id,
            'description' => 'this is my Secord car Trim',
            'status' => '1',
            'created_at'=> now(),
            'updated_at'=> now()
        ],
        [
            'name' => '2019 A6 2.0T Premium Plus quattro 4dr Sedan AWD (2.0L 4cyl Turbo 8A)',
            'model_id'=>$id,
            'description' => 'this is my Third car Trim',
            'status' => '1',
            'created_at'=> now(),
            'updated_at'=> now()
        ],
        [
            'name' => '2018 A6 2.0T Premium Plus quattro 4dr Sedan AWD (2.0L 4cyl Turbo 8A)',
            'model_id'=>$id,
            'description' => 'this is my Fourth car Trim',
            'status' => '1',
            'created_at'=> now(),
            'updated_at'=> now()
        ],
    ]);
        
    }
}
