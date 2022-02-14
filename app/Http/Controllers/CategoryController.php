<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function allCategory(){
        /* get() is used when you want to add queries and 
        all() is used to get all data, without using any condition.*/
        $categories = Category::latest('id')->paginate(5);
        //$categories = DB::table('categories')->latest('id')->paginate(1);

        /* to show deleted categories used onlyTrashed*/
        $trashCategories = Category::onlyTrashed('id')->paginate(5);
        
        return view('admin.category.index', compact(['categories', 'trashCategories']));
    }

    public function addCategory(Request $request){
       
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $data = ([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);
        $category = Category::insert($data);
        
       return back()->with('success', 'Category created successfully.');
    }

    public function editCategory($id){
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id){
        $data = ([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);
        $category = Category::find($id)->update($data);
        return redirect()->route('all.category')->with('success', 'Category updated successfully.');
    }

    public function deleteCategory($id){
        $category = Category::find($id)->delete();
        return back()->with('success', 'Category deleted successfully.');
    }

    public function restoreCategory($id){
        $category = Category::withTrashed($id)->restore();
        return back()->with('success', 'Category restored successfully.');
    }

    public function permanentDeleteCategory($id){
        $category = Category::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Category permanently deleted successfully.');
    }
}
