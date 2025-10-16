<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::query();

    if ($request->ajax()) {
        if ($request->search) {
            $search = $request->search;
            $categories->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $categories = $categories->get();
        return view('staff.categories_table', compact('categories'))->render();
    }

    $categories = $categories->get();
    return view('staff.manage_category', compact('categories'));
}

    public function create()
    {
        return view('staff.addcategory');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'required',
        ]);
        Category::create($request->all());
        return redirect()->route('staff.categories.index')->with('success', 'Category added successfully.');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('staff.editcategory', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'description' => 'required',
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('staff.categories.index')->with('success', 'Category updated successfully.');
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('staff.categories.index')->with('success', 'Category deleted successfully.');
    }

}
