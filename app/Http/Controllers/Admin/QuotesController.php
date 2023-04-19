<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotesController extends Controller
{
    public function index()
    {

        $quotes = Quote::with('category')->paginate(6);
        return view('admin.quotes.index', [
            'quotes' => $quotes
        ]);
    }

    public function show($id, $categ_id)
    {


        $data = Quote::findOrFail($id);
        $categories = Category::all()->whereNotIn('id', $categ_id);


        return view('admin.quotes.update', [
            'data' => $data,
            'categories' => $categories

        ]);
    }

    public function add()
    {


        $categories = Category::all();
        return view('admin.quotes.add', [
            'categories' => $categories
        ]);
    }

    public function addto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote' => 'required|min:5',
            'category_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $data = new Quote();
            $data['category_id'] = strip_tags($request->input('category_name'));
            $data['quote'] = strip_tags($request->input('quote'));
            $data->save();
            return response()->json([
                'status' => 200,
                'message' => 'Quote Added Successfully',
                'data' => $data,
            ]);
        }
    }

    public function update(Request $request)
    {

        $request->validate([
            'category_name' => 'required',
            'quote' => 'required',
        ]);

        $data = Quote::findOrFail($request->input('id'));
        $data->category_id = strip_tags($request->input('category_name'));
        $data->quote = strip_tags($request->input('quote'));
        $data->update();

        return redirect()->route('quotes.index')->with('success', 'Quote updated successfully');
    }

    public function delete($id)
    {
        $data = Quote::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'Quote deleted successfully !'
        ]);
    }
}
