<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanantUser extends Model
{
    use HasFactory;
    
    protected $connection = 'fleet_admin';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tenants_user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    public function changeConnection($connection){
        $this->connection = $connection;
    }

    public function tanants(){
        return $this->belongsTo(TenantMgmt::class, 'tenant_id');
    }
}
