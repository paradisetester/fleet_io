<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\PlanInventory;
use App\Models\PlanPermissions;
use App\Models\Permission;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;

class PlansController extends Controller {

    public function index()
    {
        $plan = PlanInventory::all();
		$data = array();
		
		foreach($plan as $k=>$v){
			$feature = '';
			$PlanPermissions = PlanPermissions::with('permissions')->where('plan_id',$v->id)->get();
			if($PlanPermissions){
				$feature = '<ul class="pricing-content">';
                foreach($PlanPermissions as $key=>$plan_per){
                    $feature .= '<li><i class="fa fa-check"></i> '.$plan_per->permissions->name.'</li>';
                }
                $feature .= '</ul>';
			}
			$data['id'] = $v->id;
			$data['heading'] = $v->heading;
			$data['description'] = $v->description;
			$data['discount'] = $v->discount;
			$data['free_trial'] = $v->free_trial;
			$data['status'] = $v->status;
			$data['type'] = $v->type;
			$data['price'] = $v->price;
            $data['color'] = $v->color;
			$data['features'] = $feature;
			$data['created_at'] = $v->created_at;
			$plans[] = $data;
		}
		
	
       // $plans = PlanInventory::with('plans_permission')->with('permissions')->get();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('plans')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[           
            'heading' => 'required|string',
            'description' => 'required|string',
            'discount' => 'required|numeric',
            'free_trial' => 'required|numeric',  
            'status' => 'required|numeric',
            'type' => 'required|numeric',
            'price' => 'required|numeric'       
        ];
        return $rules;
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $post = new PlanInventory;
        $post->heading = $request->heading;
        $post->description = $request->description;    
        if($request->feature) { $post->features = $request->feature; }
        $post->discount = $request->discount;
        $post->free_trial = $request->free_trial;

        $post->status = $request->status;
        $post->type = $request->type;
        $post->color = $request->color;
        $post->price = $request->price;
        if($post->save()){
		    $this->insertPlanPermissions($request, $post->id);
        }		
		
        return Response()->json(['status'=>true,'message'=>'Plans created', 'response'=>[]], 200);
    }

    public function edit($id)
    {
        $plans = PlanInventory::find($id);
        $plans_permission = PlanPermissions::leftjoin('permissions as p', 'p.id','plan_permissions.permission_id')->where('plan_permissions.plan_id',$id)->select('name','id','slug')->get();		
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('plans','plans_permission')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $post = PlanInventory::find($id);
        $post->heading = $request->heading;
        $post->color = $request->color;
        $post->description = $request->description; 
        if($request->feature) { $post->features = $request->feature; }
        $post->discount = $request->discount;
        $post->free_trial = $request->free_trial; 
        $post->status = $request->status;
        $post->type = $request->type;
        $post->price = $request->price;
        if($post->save()){
            $this->insertPlanPermissions($request, $id);
        }
		
        return Response()->json(['status'=>true,'message'=>'Plan updated', 'response'=>[]], 200);
    }
	
	
    public function destroy(Request $request, $id)
    {       
		$posts = PlanPermissions::where('plan_id', $id)->delete();
		$post = PlanInventory::where('id', $id)->delete();
        return Response()->json(['status'=>true,'message'=>'Plan Deleted', 'response'=>[]], 200);
    }

    public function show($id){
        $plan = PlanInventory::find($id);
        $data = array();
        if($plan){
            $feature = '';
            $PlanPermissions = PlanPermissions::with('permissions')->where('plan_id',$id)->get();
            if($PlanPermissions){
                $feature = '<ul class="pricing-content">';
                foreach($PlanPermissions as $key=>$plan_per){
                    $feature .= '<li><i class="fa fa-check"></i> '.$plan_per->permissions->name.'</li>';
                }
                $feature .= '</ul>';
            }
            $data['id'] = $plan->id;
            $data['heading'] = $plan->heading;
            $data['description'] = $plan->description;
            $data['discount'] = $plan->discount;
            $data['free_trial'] = $plan->free_trial;
            $data['status'] = $plan->status;
            $data['type'] = $plan->type;
            $data['price'] = $plan->price;
            $data['color'] = $plan->color;
            $data['features'] = $feature;
            $data['created_at'] = $plan->created_at;
        }
	
        return Response()->json(['status'=>true,'message'=>'', 'response'=>['plan' => $data]], 200);
    }

    private function insertPlanPermissions($request, $plan_id){
        PlanPermissions::where('plan_id', $plan_id)->delete();
        $planPerms = Permission::whereIn('slug', ['dashboard', 'users', 'accountSubscription'])->pluck('id')->toArray();
        if(!empty($request->feature)){
            $feature = explode(',',$request->feature);
            foreach($feature as $f){
                $permission = Permission::find($f);
                $planPerms[] = $f;
                if($permission->dependent_on_sections){
                    $dependentModules = array_filter(explode(',', $permission->dependent_on_sections));
                    $planPerms = array_merge($planPerms, $dependentModules);
                }
            } 
        }
        $planPerms = array_unique($planPerms);
        foreach ($planPerms as $key => $value) {
            $PlanPermissions = new PlanPermissions;
            $PlanPermissions->plan_id = $plan_id;    
            $PlanPermissions->permission_id = $value;
            $PlanPermissions->save();
        }
    }


}

