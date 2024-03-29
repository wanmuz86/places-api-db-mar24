<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
class HotelController extends Controller
{
    //
    public function store(Request $request){
        $hotel = new Hotel();
        $hotel->fill($request->all());
        if ($hotel->save()){
            // Lepas save saya akan link kan hotel ini dengan facilities nya
            $hotel->facilities()->attach($request->facilities);
            return response()->json(["message"=> "succesfullly saved"
            ,"status"=>true]);
        }
        else {
            return response()->json(["message"=>"An error happen try again"
            ,"status"=>false]);
        }
    }

    public function index(){
        $hotels = Hotel::all();
        return response()->json(["data"=>$hotels, "status"=>"ok"]);
    }

    public function show($id){
        $hotel = Hotel::with('facilities')->with('reviews')->find($id);
        return response()->json(["data"=>$hotel,"status"=>"ok"]);
    }

    public function update($id, Request $request){
        $hotel = Hotel::find($id);
        if ($hotel){
            // Buang semua facility sedia ada
            $hotel->facilities()->detach();
            $updated = $hotel->fill($request->all())->save();
            if ($updated){
                // Update dengan faciity baru
                $hotel->facilities()->attach($request->facilities);
                return response()->json(["status"=>true, "data"=>$hotel]);
            }
            else {
                return response()->json(["status"=>false, "message"=> "unable to save"]);
            }
        }
        else {
            return response()->json(["status"=>false,"message"=>"Hotel Id not found"]);
        }
    }



    public function delete($id){
        $hotel = Hotel::find($id);
        if ($hotel){
            if ($hotel->delete()){
                return response()->json(["status"=>true,"message"=>"Successfully deleted"]);
            }
            else {
                return response()->json(["status"=>false,"message"=>"Unable to delete"]);
            }
        } else {
            return response()->json(["status"=>false,"message"=>"hotel id not found"]);
        }
    }
}
