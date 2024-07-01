<?php

namespace App\Http\Controllers\Api;

//import Model "Post"
use App\Models\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

//import Resource "PostResource"
use App\Http\Resources\PostResource;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //register
    public function tambah(Request $request){
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'product_code' => 'required',
            'description' => 'required'

        ]);

        Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'product_code' => $request->product_code,
            'description' => $request->description
        ]);

        return response()->json([
            "status" => true,
            "message" => "Data berhasil ditambah"
        ]);

    }

    public function edit(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required',
            'product_code' => 'required',
            'description' => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $product = Product::find($id);
            $product->update([
                'title' => $request->title,
                'price' => $request->price,
                'product_code' => $request->product_code,
                'description' => $request->description
         ]);


        //return response
        return response()->json([
            "status" => true,
            "message" => "Data berhasil diedit"
        ]);
    }

    public function delete($id)
    {

        //find post by ID
        $product = Product::find($id);
        //delete post
        $product->delete();

        return response()->json([
            "status" => true,
            "message" => "Data berhasil dihapus"
        ]);
    }

}
