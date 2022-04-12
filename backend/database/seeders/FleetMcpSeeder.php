<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FleetMcpSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \App\Models\Tenant::create(['name' => 'Admin', 'tenant_id' => 'fleet_admin', 'tenant_db' => 'fleet_admin']);
        \App\Models\Tenant::create(['name' => 'MCP', 'tenant_id' => 'fleet_mcp', 'tenant_db' => 'fleet_mcp']);
    }

}
