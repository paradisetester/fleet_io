<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\ThemeSetting;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;
use App\Traits\{
    HelperTrait,
    UserTrait
};

class ThemeSettingController extends Controller {
    use HelperTrait, UserTrait;

    public function index()
    {
        $themesetting = ThemeSetting::first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('themesetting')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[    
                   
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
        $themesetting = new ThemeSetting;
        $themesetting->title =$request->title;
        $themesetting->header =$request->header;
        $themesetting->footer =$request->footer;
        $themesetting->phoneno =$request->phoneno;
         if ($request->pageFile) {
            $themesetting->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        $themesetting->save();
        return Response()->json(['status'=>true,'message'=>'Theme created', 'response'=>[]], 200);
    }

    public function edit($id)
    {
        $themesetting = ThemeSetting::where('id',$id)->first();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('themesetting')], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $themesetting = ThemeSetting::where('id',$id)->first();
        $themesetting->title =$request->title;
        $themesetting->header =$request->header;
        $themesetting->footer =$request->footer;
        $themesetting->phoneno =$request->phoneno;
         if ($request->pageFile) {
            $themesetting->photo = $this->fileuploadExtra($request, 'pageFile');
        }
        $themesetting->save();
        return Response()->json(['status'=>true,'message'=>'Theme updated', 'response'=>[]], 200);
    }
    public function destroy(Request $request, $id)
    {
        $themesetting = ThemeSetting::where('id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Theme Deleted', 'response'=>[]], 200);
    }
}

