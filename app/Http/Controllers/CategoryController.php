<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category page
    public function index(){
        $categoryData = Category::paginate(4);
        // dd( $categoryData->toArray() );
        return view ('admin.category.index',compact('categoryData'));
    }

    //direct category create page
    public function categoryCreatePage(){
        return view('admin.category.createPage');
    }

    //category creating
    public function categoryCreate(Request $request){
        $categoryData = $this->validationCategoryData($request);
        $categoryData = $this->getCategoryData($request);

        Category::create($categoryData);
        return redirect()->route('category')->with(['createSuccess' => 'Category Created...']);
    }

    //deleting category
    public function categoryDelete($id){
       $categoryDataId = Category::where('category_id',$id)->delete();
       return back()->with(['deleteSuccess' => 'Category Deleted ...']);
    }

    //direct edit page
    public function categoryEditPage($id){
        $categoryData = Category::where('category_id',$id)->first();
        return view('admin.category.editPage',compact('categoryData'));
    }

    //edit category
    public function categoryUpdate($id,Request $request){
       $validate = $this->validationCategoryData($request);
       $data = $this->getCategoryData($request);
       Category::where('category_id',$id)->update($data);
       return redirect()->route('category')->with(['updateSuccess' => 'Category Updated...']);
    }

    //category get data
    private function getCategoryData($request){
        return [
            'name' => $request->categoryName,
            'description' => $request->categoryDescription,
        ];
    }

    //validation categoryData checking
    private function  validationCategoryData($request){
        Validator::make($request->all(),[
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ],[
            'categoryName.required' => 'Category Name is required!',
            'categoryDescription.required' => 'Category Description is required!'
        ])->validate();
     }

}
