<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, DateTime, Session, Redirect, Auth;
use \App\Models\V1\Links;

class MenuController extends Controller
{
    public function index(){
        $menus = Links::orderBy('link_order', 'ASC')->get();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('menus')], 200);
    }
    public function store(Request $request){
        $menus = $request->input('menus');
        $deletedItem = $request->input('deletedItem');
        if (count($deletedItem) > 0) {
            Links::whereIn('link_id', $deletedItem)->delete();
        }
        foreach($menus as $key => $menu) {
            self::insertUpdateMenu($menu['link_id'], $key, $menu['post_id'], $menu['link_parent'], $menu['link_name'], $menu['link_url']);
        }

        $menus = Links::orderBy('link_order', 'ASC')->get();
        return Response()->json(['status'=>true,'message'=>'Addedd Successfully', 'response'=>compact('menus')], 200);
    }
    public static function insertUpdateMenu($link_id, $link_order, $post_id, $link_parent, $link_name, $link_url){
        if (!$menu = Links::where('link_id', $link_id)->get()->first()) {
            $menu = new Links();
            $menu->updated_at = new DateTime;            
        }
        $menu->link_name = $link_name;
        $menu->link_url = $link_url;
        $menu->post_id = $post_id;
        $menu->link_order = $link_order;
        $menu->link_parent = $link_parent;
        $menu->created_at = new DateTime;
        $menu->save();
        return $menu->link_id;
    }
    public function deleteMenuItems(Request $request)
    {
        $targettype = $request->input('targettype');
        $target = $request->input('target');
        $post_id = $request->input('post_id');
        $link_id = $request->input('link_id');
        $relation = $request->input('relation');
        $menu = Links::where('link_id', $link_id)->where('link_target', $target)->where('target_type', $targettype)->where('post_id', $post_id)->where('link_rel', $relation)->get()->first();
        $menu->delete();
        Links::where('link_parent', $menu->link_id)->update(['link_parent' => 0]);
        die('delete');
    }
}
