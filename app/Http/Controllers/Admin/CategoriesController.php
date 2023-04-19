<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class CategoriesController extends Controller
{
    public function index()
    {

        $categories = Category::paginate(5);
        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }



    public function show($id)
    {

        $data = Category::findOrFail($id);

        return view('admin.categories.update', [
            'data' => $data
        ]);
    }

    public function add(Request $request)
    {

        $validator = FacadesValidator::make($request->all(), [
            'category_name' => 'required|min:2|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $data = new Category();
            $data['category_name'] = $request->input('category_name');
            $data->save();
            return response()->json([
                'status' => 200,
                'message' => 'Category Added Successfully',
                'data'=>$data,
            ]);
        }
    }

    public function update(Request $request)
    {

        $request->validate([
            'category_name' => 'required'
        ]);

        $data = Category::findOrFail($request->input('id'));
        $data->category_name = $request->input('category_name');
        $data->update();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {

        $data = Category::findOrFail($id);
        $data->delete();

        return response()->json(['success' => 'Category Deleted successfully !']);
    }
}
