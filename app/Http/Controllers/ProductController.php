<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Faker\Core\File;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function show()
    {
        $data = Product::all();
        return view('products.product-list', ['data' => $data]);
    }

    public function create()
    {
        return view('products.products-create');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => 'required',
            'code' => 'required|min:3',
            'price' => 'required|numeric',
        ];
        if ($request->image != "") {

            $data['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $data);
        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        $data = new Product();
        $data->name = $request->input('name');
        $data->code = $request->input('code');
        $data->price = $request->input('price');
        $data->description = $request->input('description');
        $data->save();

        if ($request->image != "") {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/products'), $imageName);
            $data->image = $request->input('$imageName');
            $data->save();
        }
        return redirect()->route('products.show')->with('success', 'Product Added Successfully!');
    }

    public function edit($id)
    {
        $product = Product::findorFail($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    // public function update($id)
    // {
    //     $data = Product::findorFail($id);

    //     $data = [
    //         'name' => 'required',
    //         'code' => 'required|min:3',
    //         'price' => 'required|numeric',
    //     ];

    //     if ($request->image != "") {

    //         $data['image'] = 'image';
    //     }
    //     $validator = Validator::make($request->all(), $data);
    //     if ($validator->fails()) {
    //         return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
    //     }
    //     //here we will update record in db
    //     $data->name = $request->input('name');
    //     $data->code = $request->input('code');
    //     $data->price = $request->input('price');
    //     $data->description = $request->input('description');
    //     $data->save();

    //     if ($request->image != "") {
    //         //delete old image
    //         // File::dalete(public_path('uploads/products/'.$data->image))

    //         //here we will store image
    //         $image = $request->image;
    //         $ext = $image->getClientOriginalExtension();
    //         $imageName = time() . '.' . $ext; //unique image name

    //         //save image to products directory
    //         $image->move(public_path('uploads/products'), $imageName);

    //         //save image name in database
    //         $data->image = $request->input('$imageName');
    //         $data->save();
    //     }
    //     return redirect()->route('products.show')->with('success', 'Product Added Successfully!');
    // }
    public function update(Request $request, $id)
    {
        $data = Product::findOrFail($id);

        $dataRules = [
            'name' => 'required',
            'code' => 'required|min:3',
            'price' => 'required|numeric',
        ];

        if ($request->hasFile('image')) {
            $dataRules['image'] = 'image';
        }
        $validator = Validator::make($request->all(), $dataRules);
        if ($validator->fails()) {
            return redirect()->route('products.edit', $id)->withInput()->withErrors($validator);
        }
        // Update record in the database
        $data->name = $request->input('name');
        $data->code = $request->input('code');
        $data->price = $request->input('price');
        $data->description = $request->input('description');
        $data->save();

        if ($request->hasFile('image')) {
            // Delete old image
            // File::delete(public_path('uploads/products/'.$data->image))

            // Store new image
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //unique image name

            // Save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            // Save image name in database
            $data->image = $imageName;
            $data->save();
        }
        return redirect()->route('products.show')->with('success', 'Product Updated Successfully!');
    }


    public function destroye($id)
    {
        $product = Product::findorFail($id);

        $product->delete();
        return redirect()->route('products.show')->with('success', 'Product delete Successfully!');
    }
}