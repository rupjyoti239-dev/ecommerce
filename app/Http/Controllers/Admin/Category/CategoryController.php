<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\FileService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::all();
        return view('admin.category.list', compact('categories'));
    }



    public function form($id = null)
    {
        if (!empty($id)) {
            $category = Category::findOrFail($id);
            return view('admin.category.form', compact('category'));
        } else {
            return view('admin.category.form');
        }
    }



    public function store(Request $request)
    {
        try {
            $validation = $request->validate([
                'category_name' => 'required|string|unique:categories,category_name,' . $request->input('id'),
                'category_slug' => 'required|string|unique:categories,category_slug,' . $request->input('id'),
                'category_image' => 'required_without:id|nullable|mimes:jpg,png,webp,jpeg|max:3000',
            ]);

            if ($request->input('id')) {
                // Update the existing category
                $category = Category::findOrFail($request->input('id'));
                
                if ($request->hasFile('category_image')) {
                    $old_image = $category->category_image;
                    FileService::delete($old_image);
                }
                $message = 'Category updated successfully';
            } else {
                // Create a new category
                $category = new Category();
                $message = 'Category created successfully';
            }

            $category->category_name = $request->input('category_name');
            $category->category_slug = $request->input('category_slug');

            if ($request->hasFile('category_image')) {
                $imageName = FileService::save($request->file('category_image'));
                $category->category_image = $imageName;
            }

            $category->save();

            return redirect()->route('admin.category.list')->with('success', $message);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }



    public function delete($id)
    {
        $category = Category::findOrFail($id);

        if ($category) {
            FileService::delete($category->category_image);
            $category->delete();
            return back();
        }
    }


    public function status($id)
    {

        // dd($id);
        $category = Category::findOrFail($id);
        // $category->status = $category->status == 1 ? 2 : 1;
        if ($category->status == 1) {
            $category->status = 2;
        } else {
            $category->status = 1;
        }
        $category->save();

        return back()->with('success', 'Status Updated Successfully');
    }
}