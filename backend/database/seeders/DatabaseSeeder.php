<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        if ((isset($_SERVER['argv']) && $_SERVER['argv'][1] == 'migrate') || (isset($_SERVER['argv']) && $_SERVER['argv'][1] == 'migrate:fresh')) {
            $this->call(FleetMcpSeeder::class);
        }else if(isset($_SERVER['argv']) && $_SERVER['argv'][1] == 'tenants:admin') {
            $this->call(PermissionTableSeeder::class); 
            $this->call(CommonDataSeeder::class);       
        }else {
            $this->call(CommonDataSeeder::class);
        }   
    }

}
