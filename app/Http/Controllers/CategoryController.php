<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Psy\Readline\Hoa\FileException;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $category= Categories::all();
        return response()->json($category,200);
    }

    public function show($id)
    {
        $brand= Categories::find($id);
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
                'image' => 'required',
            ]);
                $category= new Categories();
                if($request->hasFile('image')){
                $path= 'assets/uplaods/category'.$category->image;
                if(File::exists($path)){
                    File::delete($path);
                }
                $file=$request->file('image');
                $ext=$file->getClientOriginalExtension();
                $filename= time().'.'.$ext;
                try{
                    $file->move('assets/uploads/category',$filename);
                }catch(FileException $e)
                {
                dd($e);
                }
                $category->image=$filename;
                }
                $category->name=$request->name;
                $category->save();
            return response()->json('category added',201);
        } catch (\Exception $e) {
                return response()->json(['message'=>$e->getMessage()]);
            }
        }

     public function update(Request $request, $id)
     {
        try {
            $validate = $request->validate([
                'name' => 'required|uinque:category,name',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
                $category=Categories::find($id);
                if($request->hasFile('image')){
                $path= 'assets/uplaods/category'.$category->image;
                if(File::execsts($path)){
                    File::delete($path);
                }
                $file=$request->file('image');
                $ext=$file->getClientOriginalExtension();
                $filename= time().'.'.$ext;
                try{
                    $file->move('assets/uploads/category',$filename);
                }catch(\Exception $e)
                {
                dd($e);
                }
                $category->image=$filename;
                }
                $category->name=$request->name;
                $category->update();
                $brand= Categories::where('id',$id)->update(['name'=>$request->name]);
                return response()->json('brand updated',200);
        }catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage()]);
        }
    }
    public function delete_category($id)
    {
        $brand= Categories::find($id);
        if($brand){
            $brand->delete();
            return response()->json('brand deleted',200);
        }else  return response()->json(['message'=>'Brand not found']);
    }
}
