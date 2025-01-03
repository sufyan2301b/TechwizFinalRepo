<?php

namespace App\Http\Controllers;

use App\Models\design;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function UploadDesignView(){
        return view('AdminDashboard.uploaddesign');
    }
    public function AddDesign(Request $request){
        $design = new design();

        $image=$request->file('image');
        $ext= rand().".".$image->getClientOriginalName();
        $image->move("Images/",$ext);
        $design->image=$ext;

        $design->category = $request->product;

        $design->save();
        return redirect()->back()->with("success","Design Uploaded");
    }
}
