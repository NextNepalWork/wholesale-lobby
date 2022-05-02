<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Address;
use App\Location;
use App\State;
use Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
         return response()->json([
            'success' => true,
            'message' => 'Address Retrieve Successfully',
            'data'=> Auth::user()->addresses,
        ]); 
    }
    public function districts(){
        $states = State::get();
        $data = [];
        foreach($states as $a => $b){
            $z = [
                'id' => $b->id,
                'name' => $b->name,
            ];
            array_push($data,$z);
        }
        return response()->json([
            'success' => true,
            'message' => 'Districts Retrieve Successfully',
            'data'=> $data,
        ]); 
    }
    public function getLocation($id){
        $states = Location::where('id',$id)->first();
        $data = [
            'id' => $states->id,
            'name' => $states->name,
            'delivery_charge' => $states->delivery_charge
        ];
        return response()->json([
            'success' => true,
            'message' => 'Districts Retrieve Successfully',
            'data'=> $data,
        ]); 
    }
    public function locations($id){        
        $states = Location::where('district',$id)->get();
        $data = [];
        foreach($states as $a => $b){
            $z = [
                'id' => $b->id,
                'name' => $b->name,
                'delivery_charge' => $b->delivery_charge
            ];
            array_push($data,$z);
        }
        return response()->json([
            'success' => true,
            'message' => 'Locations Retrieve Successfully',
            'data'=> $data,
        ]); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = new Address;
        $address->user_id = strval(Auth::user()->id);
        $address->email = Auth::user()->email;
        $address->address = $request->address;
        $address->country = $request->country;
        $address->delivery_location = $request->delivery_location;
        $address->city = $request->city;
        $address->postal_code = $request->postal_code;
        $address->phone = $request->phone;
        $address->save();

        return response()->json([
            'data' => $address,
            'message' => 'Address Added Successfully !!'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        if(!$address->set_default){
            $address->delete();
             return response()->json([
            
            'message' => 'Address  Successfully Deleted!!'],200);
        }
          return response()->json([
 
            'message' => 'Default Address Cannot Be Deleted !!'],200); 
    }

    public function set_default($id){
        foreach (Auth::user()->addresses as $key => $address) {
            $address->set_default = 0;
            $address->save();
        }
        $address = Address::findOrFail($id);
        $address->set_default = 1;
        $address->save();
  return response()->json([
            'data' => $address,
            'message' => 'Default Address Changed !!'],200);
    }
}
