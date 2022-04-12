<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Tenant extends Model
{
    use HasFactory;
    
    protected $connection = 'fleet_mcp';
    
    protected $gurded = []; 
    
    public function configure(){
        
        config([
            'database.connections.fleet_tenant.database' => $this->tenant_db,
        ]);
        
        DB::purge('fleet_tenant');
        
        DB::reconnect('fleet_tenant');
        
        Schema::connection('fleet_tenant')->getConnection()->reconnect();
        
        return $this;
        
    }
    
    public function use(){
        
        #app()->getInstsance('tenant');
        
        app()->instance('fleet_tenant', $this);
        
        return $this;
    }
    
   
}



