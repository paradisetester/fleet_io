<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TenantMgmt;
use App\Models\Tenant;
use App\Models\SiteDetails;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Guzzle\Http\Exception\ClientErrorResponseException;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tenantsData = TenantMgmt::with('plan_inventory')->whereNotIn('uid',['fleet_admin'])->get();
        $tenants = [];
        foreach ($tenantsData as $key => $tenant) {
            $tenants[] = [
                'id' => $tenant->id,
                'database' => $tenant->database_name,
                'name' => $tenant->tenant_name,
                'email' => $tenant->tenant_email,
                'mobile' => $tenant->tenant_number,
                'company_name' => $tenant->company_name,
                'industry' => $tenant->industry,
                'time_zone' => $tenant->time_zone,
                'plan_id' => $tenant->plan_id,
                'plan_name' => $tenant->plan_inventory->heading,
                'plan_color' => $tenant->plan_inventory->color,
                'plan_valid_till' => $tenant->valid_till,
                'is_paid' => $tenant->is_paid,
                'is_active' => $tenant->is_active,
                'under_maintenance' => $tenant->under_maintenance,
                'status' => $tenant->tenant_status,
                'created_at' => $tenant->created_at
            ];
        }
        return Response()->json(['status'=>true, 'response'=>compact('tenants')], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function update(Request $request, $uid){
         $Tenant = TenantMgmt::where('id', $uid)->first();
         $Tenant->is_active = $request->is_active;        
         $Tenant->save();

        $token = $request->bearerToken();
        $tenant_id = $request->tenantid;
        $api_get_tenants = url("/api/v1/tenants");
        
        $client = new \GuzzleHttp\Client();
        return $response = $client->request(
            'POST', 
            "http://fleet.localhost/api/v1/tenants/updates/".$Tenant->id, 
            [
                'headers' => [
                    "authorization" => "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYjMyMGQyZmJlMmJjZDFkYjM4MWIwMTUzZDkxOGMzMDAyMTZlM2IyZDcyYThlNTFhZGYyNTlkY2VhOWI2ZTY4N2ZjYTVjMDljYmI4ZTQ2NWYiLCJpYXQiOjE2MTQxNTE0MjEsIm5iZiI6MTYxNDE1MTQyMSwiZXhwIjoxNjQ1Njg3NDIxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.L-DBXNZ9AJUWv-sQ37FYeoDcY6jA-vbWEIFvgA_h7QNCFf5zP-1o2nKq8AjdErfjkAXbdCzWSNf0OQJiRQlBmx4oq2mv1CW8MdUwl1TWgQ3IJpVA0ibqYsX2TUmPANw_87lFTdGDO0-xgChBcf8mzGvR_qIB2qWjnG2u-oGdTEE6JJq3b-sKVXoDmFAWswQxbtZY0HbX7vzMEOq1ZkIR7aDwYbaH1shwzxu7lx0xKIXNGEiIfqpI2x-xHHYcfE4Dy1d7VTj-q1egURWUBu7C7ALcWLXdQGh5S21RvWmjg8bucfkewFQlVPl8XvX-si2pjGgR4DyOyOULIVam64RdrQoopI3GKNJt_XcBlcOmqbzxCkuXM9KanLyUDuaQN0XQff6KqF5Oqa0NTJ0t05NWSwFqQxgzCIkOThD6PdMVbB4CGWmqCL-4coVYjdKfOfEf6swYbATJZ7n9UFjnbiKEW6cjvfB85iQLHbjQSRwjhQ5gOb5Y6qNwCHA3ps1ShI3srUpg5_8MTA798WJjAvBoY02hzJ_5aJIFnu8cdfZqQSdTBvvIBDFyhQYJapC6ebD9GkysMVN0IkfFAoiVpS5wCi1BCaGUgQjW6yQmv6cBh_RUp3CTRyNa9XAiwX7mPZTc4YWKQ5A6c3opn7wTBc5pLaDMKf6RbI_ILRBer9e9oeE",
                    "TenantId" => $tenant_id
                ]
            ]
        )->getBody()->getContents();
   
    }

    public function changeTenantStatus(Request $request, $uid) {
        $pdo = DB::connection()->getPdo();
        //$tenant = TenantMgmt::where('uid', $request->tenant_id)->first();
        $tenant = SiteDetails::where('tenant_id', $uid)->first();
        $tenant->is_active = $request->is_active;        
        $tenant->save();

        return Response()->json(['status' => true, 'message' => 'Tenant updated', 'response' => [$tenant]], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tenantData = TenantMgmt::with('plan_inventory')->where('id',$id)->first();
        $tenant = [
            'id' => $tenantData->id,
            'name' => $tenantData->tenant_name,
            'email' => $tenantData->tenant_email,
            'mobile' => $tenantData->tenant_number,
            'company' => [
                'name' => $tenantData->company_name,
                'tagline' => $tenantData->tagline,
                'email' => $tenantData->tenant_email,
                'mobile' => $tenantData->tenant_number,
                'industry' => ($tenantData->industry ? $tenantData->industry : 'Others'),
                'database' => $tenantData->database_name,
                'plan_id' => $tenantData->plan_id,
                'plan_name' => $tenantData->plan_inventory->heading,
                'plan_type' => ($tenantData->is_paid ? 'Paid' : 'Free'),
                'timezone' => $tenantData->time_zone,
                'currency' => $tenantData->currency,
                'plan_valid_till' => $tenantData->valid_till,
                'fleet_size' => $tenantData->folder_size ?? 'N/A' ,
                'under_maintenance' => ($tenantData->under_maintenance ? 'Yes' : 'No'),
                'status' => ($tenantData->is_active ? 'Active' : 'In-Active'),
                'created_at' => $tenantData->created_at
            ]
        ];
        return Response()->json(['status'=>true, 'response'=>compact('tenant')], 200);
    }

    public function destroy(Request $request, $id){
        $tenantMgmt = TenantMgmt::find($id);
        if($tenantMgmt){
            $result = $tenantMgmt->delete();
            if($result){
                Tenant::where('tenant_id', $tenantMgmt->uid)->delete();
                DB::statement("DROP DATABASE `{$tenantMgmt->database_name}`");
                return Response()->json(['status'=>true, 'message'=>'Tenant deleted successfully!'], 200);
            }
            return Response()->json(['status'=>false, 'message'=>'Sorry! Server Not Respond.'], 400);
        }
    }
}
