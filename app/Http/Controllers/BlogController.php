<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function BlogView(){
        return view('AdminDashboard.uploadblog');
    }
    public function AddBlog(Request $request){
        $blog = new blog();

        $blog->title = $request->title;
        $blog->description = $request->desc;
        $blog->author = $request->author;
        $blog->date = $request->date;

        $image=$request->file('image');
        $ext= rand().".".$image->getClientOriginalName();
        $image->move("Images/",$ext);
        $blog->image=$ext;

        $blog->save();
        return redirect()->back()->with("success","Blog Added Successfully");
    }
}
