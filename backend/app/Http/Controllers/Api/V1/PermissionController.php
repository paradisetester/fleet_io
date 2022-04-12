<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\Permission;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;
use App\Traits\{
    HelperTrait,
    UserTrait
};

class PermissionController extends Controller {
    use HelperTrait, UserTrait;


    public function index(Request $request){
		$permissions = $this->getPermissionsLikeSidebar($request);
        return Response()->json(['status'=>true,'message'=>'', 'response'=>$permissions], 200);
	}
	
	protected function getPermissionsLikeSidebar($request){
		$from = $request->get('from') ? $request->get('from') : '';
		$permissionArray = array();
		if($from == 'plan_page'){
			$permissions = Permission::with('modules')->groupBy('module_id')->where('for_only_admin', '0')->orderBy('module_order', 'asc')->get();
		}else{
			$permissions = Permission::with('modules')->where('type',1)->groupBy('module_id')->orderBy('module_order', 'asc')->get();
		}
		foreach($permissions as $permission){
			$url = $permission->modules[0]->url;
			if(!$url){
				$sectionArray = array();
				if($from == 'plan_page'){
					$sections = Permission::with('sections')->where('module_id',$permission->module_id)->orderBy('section_order', 'asc')->get();
				}else{
					$sections = Permission::with('sections')->where('type',1)->where('module_id',$permission->module_id)->orderBy('section_order', 'asc')->get();
				}
				foreach($sections as $section){
					$dependent_on = array_filter(explode(',',$section->dependent_on_sections));
					$sectionArray[] = [
						'id' => $section->id,
						'slug' => $section->slug,
						'name' => $section->sections[0]->name,
						'url' => $section->sections[0]->url,
						'icon' => $section->sections[0]->icon,
						'dependent_on' => $this->convertValueToIntegerInArray($dependent_on)
					];
								
				}
			}
			$dependent_on = $permission->dependent_on_sections;
			$permissionArray[] = [
				'id' => $permission->id,
				'slug' => $permission->modules[0]->slug,
				'name' => $permission->modules[0]->name,
				'icon' => $permission->modules[0]->icon,
				'url' => $url,
				'dependent_on' => $this->convertValueToIntegerInArray(array_filter(explode(',',$dependent_on))),
				'submenu' => (isset($sectionArray) ? $sectionArray : false)
			];

		}

		return $permissionArray;
	}

	protected function convertValueToIntegerInArray($data){
		return array_map(function($value){
			return !is_integer($value) ? (int)$value : $value;
		}, $data);
	}

   
}

