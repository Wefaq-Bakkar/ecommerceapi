<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Psy\Readline\Hoa\FileException;

class ProductController extends Controller
{
    //
    public function index(){
        $products=Product::paginate(10);
        if($products){
            return response()->json($products,200);
        }else {
            return response()->json(['No products found'],404);
        }
    }
    public function show($id){
        $product=Product::find($id);
        if($product){
            return response()->json($product,200);
        }else {
            return response()->json(['No product found'],404);
        }
    }
    public function store(Request $request){
       Validator::make ($request->all(),[
           'name'=>'required',
           'price'=>'required|numeric',
           'category_id'=>'required',
           'brand_id'=>'required',
           'dicount'=>'required|numeric',
           'amount'=>'required|numeric',
           'image'=>'required'
       ]);
         $product=new Product();
            $product->name=$request->name;
            $product->price=$request->price;
            $product->category_id=$request->category_id;
            $product->brand_id=$request->brand_id;
            $product->discount=$request->discount;
            $product->amount=$request->amount;
            $product->image=$request->image;
            if($request->hasFile('image')){
                $path= 'assets/uplaods/product'.$product->image;
                if(File::exists($path)){
                    File::delete($path);
                }
                $file=$request->file('image');
                $ext=$file->getClientOriginalExtension();
                $filename= time().'.'.$ext;
                try{
                    $file->move('assets/uploads/product',$filename);
                }catch(FileException $e)
                {
                dd($e);
                }
                $product->image=$filename;
                }
                $product->save();
                return response()->json('product added',201);
    }
    public function update(Request $request, $id){
        Validator::make ($request->all(),[
            'name'=>'required',
            'price'=>'required|numeric',
            'category_id'=>'required',
            'brand_id'=>'required',
            'dicount'=>'required|numeric',
            'amount'=>'required|numeric',
            'image'=>'required'
        ]);
        $product=Product::find($id);
        if($product){
            $product->name=$request->name;
            $product->price=$request->price;
            $product->category_id=$request->category_id;
            $product->brand_id=$request->brand_id;
            $product->discount=$request->discount;
            $product->amount=$request->amount;
            $product->image=$request->image;
            if($request->hasFile('image')){
                $path= 'assets/uplaods/product'.$product->image;
                if(File::exists($path)){
                    File::delete($path);
                }
                $file=$request->file('image');
                $ext=$file->getClientOriginalExtension();
                $filename= time().'.'.$ext;
                try{
                    $file->move('assets/uploads/product',$filename);
                }catch(FileException $e)
                {
                dd($e);
                }
                $product->image=$filename;
                }
                $product->save();
                return response()->json('product updated',201);
        }else {
            return response()->json(['No product found'],404);
        }
    }
    public function destroy($id){
        $product=Product::find($id);
        if($product){
            $product->delete();
            return response()->json('product deleted',200);
        }else {
            return response()->json(['No product found'],404);
        }
    }
}
