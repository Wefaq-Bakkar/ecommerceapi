<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    //
    public function index()
    {
        $locations= Locations::all();
        return response()->json($locations,200);
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
               // 'user_id' => 'required',
                'street' => 'required',
                'building' => 'required',
                'area' => 'required',
            ]);
           $location= new Locations();
           $location->user_id =  Auth::id();
          $location->street = $request->street;
          $location->building = $request->building;
           $location->area = $request->area;
           $location->save();
           return response()->json('Location added',201);
         } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage()]);

    }

       /*    Locations::create([
              'user_id' => Auth::id(),
             'street' => $request->street,
             'building' => $request->building,
              'area' => $request->area,
          ]);*/
          //  return response()->json('Location added',201);
        }
        public function update(Request $request, $id)
        {
            $validate = $request->validate([
                // 'user_id' => 'required',
                 'street' => 'required',
                 'building' => 'required',
                 'area' => 'required',
             ]);

            dd($request->all());

            // Rest of your code for updating the location
            $location = Locations::where('id', $id)->first();
            if($location){
                try{
                 $location->street = $request->get('street');
                 $location->building = $request->get('building');
                 $location->area = $request->get('area');
                 $location->save();
                return response()->json('Location updated',201);}
                catch (\Exception $e) {
                    return response()->json(['message'=>$e->getMessage()]);
                }
            }else return response()->json(['Location not found']);
        }
        public function destroy($id)
        {
            $location= Locations::find($id);
            if($location){
                $location->delete();
                return response()->json('Location deleted',200);
            }else  return response()->json(['Location not found']);
        }
}
