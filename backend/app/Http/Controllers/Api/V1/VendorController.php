<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\Vendor;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;
use App\Traits\{
    HelperTrait,
    UserTrait
};

class VendorController extends Controller {
    use HelperTrait, UserTrait;

    public function index($type='')
    {
        $type = @$_GET['type'];
        if($type){
            $vendors = Vendor::where('Fuel',1)->orderBy('vendor_id', 'ASC')->get();
        }else{
          $vendors = Vendor::orderBy('vendor_id', 'ASC')->get();  
        }
        
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vendors')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[    
            'name' => 'required',         
            'phone' => 'required',        
            'website' => 'required',        
            'labels' => 'required',        
            'address' => 'required',        
            'address_line_2' => 'required',        
            'city' => 'required',        
            'state' => 'required',        
            'postal_code' => 'required',        
            'country' => 'required',        
            'contact_name' => 'required',        
            'contact_email' => 'required',        
            'contact_phone' => 'required',        
            'fuel' => 'required',        
            'service' => 'required',        
            'vehicle' => 'required',        
        ];
        return $rules;
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), self::storeRules($request));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $vendor = new Vendor;
        $vendor->user_id =$this->getCurrentUserID();
        $vendor->name =$request->name;
        $vendor->phone =$request->phone;
        $vendor->website =$request->website;
        $vendor->labels =$request->labels;
        $vendor->address =$request->address;
        $vendor->address_line_2 =$request->address_line_2;
        $vendor->city =$request->city;
        $vendor->state =$request->state;
        $vendor->postal_code =$request->postal_code;
        $vendor->country =$request->country;
        $vendor->country =$request->country;
        $vendor->contact_name =$request->contact_name;
        $vendor->contact_email =$request->contact_email;
        $vendor->contact_phone =$request->contact_phone;
        $vendor->fuel =$request->fuel;
        $vendor->service =$request->service;
        $vendor->vehicle =$request->vehicle;
        $vendor->save();
        return Response()->json(['status'=>true,'message'=>'Vendor created', 'response'=>[]], 200);
    }

    public function edit($id)
    {
        $vendor = Vendor::where('vendor_id',$id)->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('vendor')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $vendor = Vendor::where('vendor_id',$id)->first();
        $vendor->name =$request->name;
        $vendor->phone =$request->phone;
        $vendor->website =$request->website;
        $vendor->labels =$request->labels;
        $vendor->address =$request->address;
        $vendor->address_line_2 =$request->address_line_2;
        $vendor->city =$request->city;
        $vendor->state =$request->state;
        $vendor->postal_code =$request->postal_code;
        $vendor->country =$request->country;
        $vendor->country =$request->country;
        $vendor->contact_name =$request->contact_name;
        $vendor->contact_email =$request->contact_email;
        $vendor->contact_phone =$request->contact_phone;
        $vendor->fuel =$request->fuel;
        $vendor->service =$request->service;
        $vendor->vehicle =$request->vehicle;
        $vendor->save();
        return Response()->json(['status'=>true,'message'=>'Vendor updated', 'response'=>[]], 200);
    }
    public function destroy(Request $request, $id)
    {
        $vendor = Vendor::where('vendor_id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Vendor Deleted', 'response'=>[]], 200);
    }
}

