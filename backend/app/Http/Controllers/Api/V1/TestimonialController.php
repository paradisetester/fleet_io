<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\V1\Posts;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect;
use App\Traits\{
    HelperTrait,
    UserTrait
};

class TestimonialController extends Controller {
    use HelperTrait, UserTrait;
    
    public function index()
    {
        $posts = Posts::where('type','testimonial')->get();
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('posts')], 200);
    }

    public static function storeRules($request, $id = null)
    {
        $rules=[            
            'title' => 'required|string',
            'heading' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'type' => 'required',
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
        $postCount = Posts::where('title', $request->title)->get()->count();
        if ($postCount > 0) {
            $post_name = $request->title.' '.$postCount;
        }else{
            $post_name = $request->title;
        }
        $post_name = Str::slug($post_name, '-');
        $post = new Posts;
        $post->user_id = $this->getCurrentUserID();
        $post->title = $request->title;
        $post->heading = $request->heading;
        $post->slug = $post_name;
        if ($request->pageFile) {
            $post->image = $this->fileuploadExtra($request, 'pageFile');
        }
        $post->description = $request->description;
        $post->status = $request->status;
        $post->template = $request->template;
        $post->short_description = $request->short_description;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->type = $request->type;
        $post->save();
        return Response()->json(['status'=>true,'message'=>'Post created', 'response'=>[]], 200);
    }

    public function edit($id)
    {
        $post = Posts::find($id);
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('post')], 200);
    }

    public function update(Request $request, $id)
    {
		
        $validator = Validator::make($request->all(), self::storeRules($request, $id));
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->first();
            return Response()->json(['status'=>false,'message'=>$errors, 'response'=>[]], 401);
        }
        $post = Posts::where('post_id',$id)->first();
        $post->title = $request->title;
        $post->heading = $request->heading;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->template = $request->template;
        if ($request->pageFile) {
            $post->image = $this->fileuploadExtra($request, 'pageFile');
        }
        $post->short_description = $request->short_description;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->save();
        return Response()->json(['status'=>true,'message'=>'Post updated', 'response'=>[]], 200);
    }
    public function destroy(Request $request, $id)
    {
        $post = Posts::where('post_id',$id)->delete();
        return Response()->json(['status'=>true,'message'=>'Post Deleted', 'response'=>[]], 200);
    }
    public function getPostPage($slug = null)
    {
        $post = Posts::where('slug', $slug)->get()->first();
        if (!$post) {
            $post->template = 'notFound';
        }
        return Response()->json(['status'=>true,'message'=>'', 'response'=>compact('post')], 200);
    }
}

