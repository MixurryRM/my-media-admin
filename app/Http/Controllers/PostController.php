<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::paginate(3);
        return view('admin.post.index', compact('post'));
    }

    //direct post create page
    public function postCreatePage()
    {
        $categoryData = Category::get();
        return view('admin.post.createPage', compact('categoryData'));
    }

    //post creating
    public function postCreate(Request $request)
    {
        $validator = $this->checkPostValidation($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // $fileName = uniqid().$request->file('postImage')->getClientOriginalName();
        // $fileName = $request->file('postImage')->storeAs('public/',$fileName);

        if (!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);
            $data = $this->getPostData($request, $fileName);
        } else {
            $data = $this->getPostData($request, null);
        }

        Post::create($data);
        return redirect()->route('post');
    }

    //deleting post
    public function postDelete($id)
    {
        $postData = Post::where('post_id', $id)->first();
        $dbImage = $postData['image'];

        Post::where('post_id', $id)->delete();

        if (File::exists(public_path() . '/postImage/' . $dbImage)) {
            File::delete(public_path() . '/postImage/' . $dbImage);
        }

        return back();
    }
    //direct edit post page
    public function postEditPage($id)
    {
        $categoryData = Category::get();
        $postData = Post::where('post_id', $id)->first();
        // dd($postData->toArray());
        return view('admin.post.editPage', compact('categoryData', 'postData'));
    }

    //post updating
    public function postUpdate($id, Request $request)
    {
        $validator = $this->checkPostValidation($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        };

        $data = $this->getPostUpdateData($request);

        if (isset($request->postImage)) {

            //get client image original name
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();

            //put to db array
            $data['image'] = $fileName;

            //delete from publc folder
            $postData = Post::where('post_id', $id)->first();
            $dbImageName = $postData['image'];

            if (File::exists(public_path() . '/postImage/' . $dbImageName)) {
                FIle::delete(public_path() . '/postImage/', $dbImageName);
            }

            //move to public folder new image
            $file->move(public_path() . '/postImage/' . $fileName);

            Post::where('post_id', $id)->update($data);
        } else {
            Post::where('post_id', $id)->update($data);
        }
        return back();
    }


    public function postListSearch(Request $request)
    {
        $post = Post::Where('title', 'like', '%' . $request->key . '%')
            ->paginate(3);
        return view('admin.post.index', compact('post'));
    }

    //getting post data
    private function getPostUpdateData($request)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
        ];
    }

    //getting post data
    private function getPostData($request, $fileName)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
        ];
    }

    //check validation post
    private function checkPostValidation($request)
    {
        return Validator::make($request->all(), [
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required',
            'postImage' => "mimes:jpg,jpeg,png,webp|file",
        ]);
    }
}
