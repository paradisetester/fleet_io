<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TenantMgmt;
use App\Models\PlanInventory;
use App\Models\User;
use App\Models\Payment;
use App\Models\V1\VehicleAssignment;
use App\Models\V1\VehicleDetails;
use App\Models\V1\VehicleInspection;

class DashboardController extends Controller
{
    public function index(Request $request){
        $tenantId = $request->header('tenantid');
        $users_count = User::count();
        if($tenantId == 'fleet_admin'){
            $tenants_count = TenantMgmt::whereNotIn('uid', ['fleet_admin'])->count();
            $plans_count = PlanInventory::count();
            $roundoff = Payment::where('order_status', 1)->sum('order_total_amount');
            $total_payment = number_format($roundoff,2);
            $orders_count = Payment::count();

           

            return Response()->json(['status'=>true, 'response'=>compact('users_count','tenants_count','plans_count','total_payment','orders_count')], 200);
        }else{

$VehicleInspection = VehicleInspection::select(VehicleInspection::raw('count(inspection_id) as `data`'), VehicleInspection::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  VehicleInspection::raw('YEAR(created_at) year, MONTH(created_at) month'))
->groupby('year','month')
->get();

            $currentDate = date('Y-m-d');
            $vehicleAssignments = VehicleAssignment::join('vehicle_details','vehicle_details.vehicle_id','vehicle_assignments.vehicle_id')->select('vehicle_assignments.*','vehicle_details.name as vehicleName')->where('start_date','>=', $currentDate)->get();
            $vehicleCount = VehicleDetails::count(); 
            $vehicleAssignmentsCount = VehicleAssignment::where('start_date','>=', $currentDate)->count();   

            return Response()->json(['status'=>true, 'response'=>compact('users_count','vehicleAssignments','vehicleCount','vehicleAssignmentsCount','VehicleInspection')], 200);
        }
    }
}
