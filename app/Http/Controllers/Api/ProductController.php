<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::orderby('id', 'desc')->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        if($request->get('photo'))
        {
            $image = $request->get('photo');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('photo'))->save(public_path('img/profile/').$name);
        }
        $data=new Product();
        $data->name = $request->name;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->photo = $name;
        $data->save();
        return response()->json(['success' => 'You have successfully Inserted Product'], 200);
    }
    public  function destroy($id)
    {
        $product=Product::findOrFail($id);
        $old_image='img/profile/'.$product->photo;
        unlink($old_image);
        $product->delete();
        return response()->json(['success' => 'You have successfully Deleted Product'], 200);


    }


    public function show($id)
    {
        $product = Product::find($id);

        return response()->json($product);
    }
    Public function  update(Request $request,$id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);
        $data=Product::findOrFail($id);
        $old_image='img/profile/'.$data->photo;

        if($request->get('photo')) {
            unlink($old_image);
            $image = $request->get('photo');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('photo'))->save(public_path('img/profile/').$name);
        }
        $data->name = $request->name;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->photo = $name;
        $data->update();
        return response()->json(['success' => 'You have successfully Updated Product'], 200);
    }


    public  function  deleteProduct($id)
    {


    }




}
