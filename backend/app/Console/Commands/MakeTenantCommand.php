<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Database\Seeders\UserSeeder;
use App\Models\PlanPermissions;
use App\Models\Tenant;
use App\Models\TenantMgmt;
use App\Traits\{
    HelperTrait
};

class MakeTenantCommand extends Command {
    use HelperTrait;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tenant {user} {dbname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make tenant command.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $user = $this->argument("user");
        $dbname = $this->argument("dbname");
        $this->makeTenant(
                Tenant::find(Tenant::where('tenant_id', "fleet_mcp")->first()->id),
                [
                    'user' => $user, 
                    'permissions' => $this->getPlanPermissions($user['plan_id']),
                    'tenant_data' => $this->getTenantData($dbname)
                ],
                $dbname
        );
    }

    private function makeTenant(
            $tenant, 
            $data,
            $dbname
            ) {
        
        $connection = $tenant->configure()->use();

        try {
            $hasDb = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = " . "'" . $dbname . "'");
            if (empty($hasDb)) {
                DB::select('CREATE DATABASE ' . $dbname);
                $this->info("Database '$dbname' created for '$connection' connection");
            } else {
                $this->info("Database $dbname already exists for $connection connection");
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        
        # do entry in mcp databae
        $this->saveTenantDataInMcp($data, $dbname);

        $this->info("Tanant Data Inserted Successfully in MCP Database!");

        # migrate in new database
        $this->call('tenants:migrate', ['tenant_id'=>$dbname]);
        $this->info("Tanant Migrate Successfully!");
        
        # create user in new database
        $userSeeder = \App::make(UserSeeder::class);
        $userSeeder->run($data);
        $this->info("Tanant Data Inserted Successfully!");
        
    }

    private function saveTenantDataInMcp($data, $dbname){
        if(!empty($data) && !empty($dbname)){
            $tenantData = isset($data['tenant_data']) && $data['tenant_data'] ? $data['tenant_data'] : [];
            $userData = isset($data['user']) && $data['user'] ? $data['user'] : [];
            $count = Tenant::count();
            $tenants = new Tenant();
            $tenants->name = 'tenant'.($count-1);
            $tenants->tenant_id = $dbname;
            $tenants->tenant_db = $dbname;
            $tenants->tenant_name = $userData['name'];
            $tenants->tenant_number = $tenantData['tenant_number'];
            $tenants->company_name = $tenantData['company_name'];
            $tenants->fleet_size = $tenantData['fleet_size'];
            $tenants->industry = $tenantData['industry'];
            $tenants->time_zone = $tenantData['time_zone'];
            $tenants->currency = $tenantData['currency'];
            $tenants->tagline = $tenantData['tagline'];
            $tenants->package_id = $tenantData['plan_id'];
            $tenants->is_trial = (isset($userData['free_trial']) && $userData['free_trial'] ? 1 : 0);
            $tenants->is_paid = $tenantData['is_paid'];
            $tenants->save();
        }
    }
    

}
