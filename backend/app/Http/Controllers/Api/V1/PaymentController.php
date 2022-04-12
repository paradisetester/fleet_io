<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;
use App\Traits\{
    UserTrait,
    StripeTrait,
    UserPlanTrait
};
use App\Models\PlanInventory;
use App\Models\Payment;

class PaymentController extends Controller {
    use StripeTrait, UserTrait, UserPlanTrait;

    public function index(){
        $payments = Payment::with('tenant')->with('plan')->orderBy('updated_at', 'desc')->get();
        $orders = [];
        foreach ($payments as $key => $payment) {
            $orders[] = [
                'order_id' => $payment->order_id,
                'order_number' => $payment->order_number,
                'plan_name' => $payment->plan->heading,
                'plan_id' => $payment->plan_id,
                'total_amount' => $payment->order_total_amount,
                'contact_name' => $payment->tenant->tenant_name,
                'contact_email' => $payment->tenant->tenant_email,
                'contact_id' => $payment->tenant_id,
                'order_date' => $payment->created_at,
                'order_status' => $payment->order_status
            ];
        }
        return Response()->json(['status'=>true, 'response'=>compact('orders')], 200);
    }
    
    public function show($id){
		
        $orderData = Payment::with('tenant')->with('plan')->where('order_id',$id)->first();
        $order = [
            'order_id' => $orderData->order_id,
            'order_number' => $orderData->order_number,
            'plan_name' => $orderData->plan->heading,
            'plan_id' => $orderData->plan_id,
            'total_amount' => $orderData->order_total_amount,
            'contact_name' => $orderData->tenant->tenant_name,
            'contact_email' => $orderData->tenant->tenant_email,
            'contact_mobile' => $orderData->tenant->tenant_number,
            'contact_id' => $orderData->tenant_id,
            'transaction_id' => $orderData->transaction_id,
            'order_date' => $orderData->created_at,
            'order_status' => $orderData->order_status
        ];
        return Response()->json(['status'=>true, 'response'=>compact('order')], 200);
    }

    public function destroy($id){
        $order = Payment::find($id);
        if($order->delete()){
            return Response()->json(['status'=>true, 'message' => 'Order Row Deleted Successfully!', 'response'=>[]], 200);
        }
        return Response()->json(['status'=>false, 'message' => 'Error! Server Not Respond.', 'response'=>[]], 200);
    }
}

