<?php

namespace App\Http\Controllers;
use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{

    public function index()
    {
        $brands= Brands::all();
        return response()->json($brands,200);
    }

    public function show($id)
    {
        $brand= Brands::find($id);
        if($brand){
            return response()->json($brand,200);
        }
        return response()->json(['message'=>'Brand not found']);
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required',
            ]);

            $brand= new Brands();
            $brand->name=$request->name;
            $brand->save();
            return response()->json('brand added',201);
        } catch (\Exception $e) {
                return response()->json(['message'=>$e->getMessage()]);
            }
        }

     public function update(Request $request, $id)
     {
        try {
            $validate = $request->validate([
                'name' => 'required',
            ]);

            $brand= Brands::where('id',$id)->update(['name'=>$request->name]);
            return response()->json('brand updated',200);
        }catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage()]);
        }
    }
    public function delete_brand($id)
    {
        $brand= Brands::find($id);
        if($brand){
            $brand->delete();
            return response()->json('brand deleted',200);
        }else  return response()->json(['message'=>'Brand not found']);
    }
}
