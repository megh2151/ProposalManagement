<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\SubCategory;

class CategoryController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role_id ==2) {
                return redirect()->route('admin.proposal.index')->with('error', 'You do not have permission to access this page.');
            }
            return $next($request);
        });
    }


    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    public function subCategoryIndex($id)
    {
        $subcategories = SubCategory::where('category_id',$id)->get();
        $category = Category::find($id);
        return view('admin.subcategories.index', compact('subcategories','id','category'));
    }
     
     

    public function create()
    {
        return view('admin.categories.create');
    }

    public function createSubcategory($id)
    {
        return view('admin.subcategories.create',compact('id'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if ($category) {
            return view('admin.categories.edit', compact('category'));
        }
    }

    public function subCategoryEdit($id,$subid)
    {
        $subcategory = SubCategory::where('category_id',$id)->find($subid);
        if ($subcategory) {
            return view('admin.subcategories.edit', compact('subcategory'));
        }
    }
    

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $name = $request->name;
        $status = $request->status;

        $category = new Category();
        $category->name = $name;
        $category->is_active = $status;
        $category->save();

        return redirect()->back()->with('success', 'Category added successfully.');
    }
    
    public function subCategoryStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $name = $request->name;
        $status = $request->status;
        $cat_id = $request->cat_id;

        $category = new SubCategory();
        $category->name = $name;
        $category->category_id = $cat_id;
        $category->is_active = $status;
        $category->save();

        return redirect()->back()->with('success', 'Sub Category added successfully.');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $status = $request->status;
        $category = Category::find($id);
        if ($category) {
            $category->name = $name;
            $category->is_active = $status;
            $category->save();
            return redirect()->back()->with('success', 'Category updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
    }

    public function subCategoryUpdate(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $status = $request->status;
        $subcategory = SubCategory::find($id);
        if ($subcategory) {
            $subcategory->name = $name;
            $subcategory->is_active = $status;
            $subcategory->save();
            return redirect()->back()->with('success', 'Sub Category updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Sub Category not found.');
        }
    }
    

    public function delete(Request $request)
    {
        $cat_id = $request->cat_id;
        $category = Category::find($cat_id);
        if ($category) {
            $category->subcategories->delete();
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
    }

    public function subCategorydelete(Request $request)
    {
        $subcat_id = $request->subcat_id;
        $subcategory = SubCategory::find($subcat_id);
        if ($subcategory) {
            $subcategory->delete();
            return redirect()->back()->with('success', 'Sub Category deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Sub Category not found.');
        }
    }
}
