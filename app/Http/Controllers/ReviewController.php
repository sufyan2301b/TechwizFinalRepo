<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function InsertReview(Request $request){
        $review = new review();

        $review->name = $request->name;
        $review->email = $request->email;
        $review->review = $request->review;

        $review->save();
        return redirect()->back()->with("success","Review Added");
    }
}
