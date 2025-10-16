<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query();
        $allCategories = Category::all(); // for dropdown

        if ($request->ajax()) {
            if ($request->search_name) {
                $categories->where('name', 'like', "%{$request->search_name}%");
            }

            if ($request->search_description) {
                $categories->where('description', 'like', "%{$request->search_description}%");
            }

            $categories = $categories->get();
            return view('admin.categories_table', compact('categories'))->render();
        }

        $categories = $categories->get();
        return view('admin.manage_category', compact('categories', 'allCategories'));
    }


    public function create()
    {
        return view('admin.addcategory');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'required',
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.editcategory', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'description' => 'required',
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

}
