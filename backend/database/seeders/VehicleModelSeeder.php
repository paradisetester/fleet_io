<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\V1\VehicleModel;

class VehicleModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$id = DB::table('vehicle_makes')->insertGetId(
    	[
            'name' => 'Audi',
            'description' => 'this is my first car',
            'status' => '1',
            'created_at'=> now(),
            'updated_at'=> now()
        ]);
        DB::table('vehicle_models')->insert([
    	[
            'name' => 'RS 7 SportBack',
            'make_id'=>$id,
            'description' => 'this is my Secord car',
            'status' => '1',
            'created_at'=> now(),
            'updated_at'=> now()
        ],
        [
            'name' => 'A8L',
            'make_id'=>$id,
            'description' => 'this is my Third car',
            'status' => '1',
            'created_at'=> now(),
            'updated_at'=> now()
        ],
        [
            'name' => 'Q2',
            'make_id'=>$id,
            'description' => 'this is my Fourth car',
            'status' => '1',
            'created_at'=> now(),
            'updated_at'=> now()
        ],
    ]);
        
    }
}
