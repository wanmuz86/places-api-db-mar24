<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //

    public function store($hotelId, Request $request){
        $review = new Review();
        $review->fill($request->all());
        $review->hotel_id = $hotelId;
        // Update user_id based on user's log in information
        $review->user_id = Auth::user()->id;

        if ($review->save()){
            return response()->json(['success'=>true,'data'=>$review]);
        }
        else {
            return response()->json(['success'=>false,'message'=>'Unable to save']);
        }
    }
}
