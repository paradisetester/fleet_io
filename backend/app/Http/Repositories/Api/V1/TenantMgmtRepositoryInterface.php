<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Repositories\Api\V1;

interface TenantMgmtRepositoryInterface {
    public function isTenantExist($email, $unique_id);
    public function addNewTenant($request);
    public function getUniqueId();
}