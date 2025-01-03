<?php

namespace App\Http\Controllers;

use App\Events\NotificationSent;
use App\Models\product;
use App\Models\addedprod;
use App\Models\registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class mycontroller extends Controller
{
public function sendNotification(Request $request)
{
    $notification = $request->input('notification');
    broadcast(new NotificationSent($notification))->toOthers();
}

    //
    public function insertdata(Request $request){
        // echo $input->username;
        $table = new registration();

        $table->name = $request->username;
        $table->email = $request->useremail;
        $table->password = $request->userpassword;
        $table->age = $request->userage;
        $table->save();
        return redirect()->back()->with("successmessage","Record has been inserted");
    }
    public function insertproduct(Request $request){
        // echo $input->username;
        $table = new product();

        $table->name = $request->name;
        $table->description = $request->desc;
        $table->price = $request->price;
        $table->category = $request->product;
        $image=$request->file('image');
        $ext= rand().".".$image->getClientOriginalName();
        $image->move("Images/",$ext);
        $table->image=$ext;
        $table->save();
        return redirect()->back()->with("successmessage","Record has been inserted");
    }
    public function getdata()
    {
        $records = registration::get();
        return view("record",compact('records'));

    }
    public function getproducts()
    {
        $records = product::get();
        return view("AdminDashboard.prods",compact('records'));

    }
    // public function delrecord($id)
    // {
    //    $specificuser = registration::find($id);
    //    $specificuser->delete();
    //    return redirect('/fetch');
    // }
    public function updateuser($id)
    {
        $specificuser = registration::find($id);
        return view("update",compact('specificuser'));
    }
    public function update(Request $req)
    {
        $specificid =  registration::find($req->userid);
        $specificid->name = $req->username;
        $specificid->email = $req->useremail;
        $specificid->password = $req->userpass;
        $specificid->age = $req->userage;
        $specificid->save();
        return redirect('/fetch');
    }
    public function insertproducts(Request $req)
    {
        $product_name = $req->post('pname');
        $product_price = $req->post('pprice');
        $quantity = $req->post('quantity');
        $total = $req->post('total');
        $userid = $req->post('uid');

        $table = new addedprod();
        $table->Product_Name = $product_name;
        $table->Product_Price = $product_price;
        $table->Product_Quantity = $quantity;
        $table->Product_Total = $total;
        $table->User_Id = $userid;
        $table->save();
        return redirect()->back()->with("atc","Record has been inserted");
    }
    // public function checkout()
    // {
    //     $atc = DB::table('addedprods')->where('User_Id',Auth::User()->id)->get();
    //     return view('checkout',compact('atc'));


    // }
    // public function deleteproduct($id)
    // {\
    //     $prd = addedprod::find($id);
    //     $prd->delete();
    //     return redirect('/checkout');
    // }
    public function ShowProduct(){
        $products = product::all();
        return view('AdminDashboard.showproducts', compact('products'));
    }
    public function DeleteProductAdmin($id){
        $products = product::find($id);
        $products->delete();
        return redirect('showproduct')->with('delete', 'Product Deleted Successfully');
    }
    public function EditProductView($id){
        $products = product::find($id);
        return view('AdminDashboard.editproduct', compact('products'));
    }
    public function EditProductAdmin(Request $request, $id){
        $products = product::find($id);

        $products->name = $request->name;
        $products->description = $request->desc;
        $products->price = $request->price;
        $image=$request->file('image');
        $ext= rand().".".$image->getClientOriginalName();
        $image->move("Images/",$ext);
        $products->image=$ext;
        $products->category = $request->category;

        $products->save();
        return redirect('showproduct')->with('Updated', 'Product Updated Successfully');
    }
    public function ShowUser(){
        $users = User::all();
        return view('AdminDashboard.users', compact('users'));
    }
    public function DeleteUser($id){
        $users = User::find($id);
        $users->delete();
        return redirect()->back()->with('delete', 'User Deleted Successully');
    }
    public function EditUserView($id){
        $user = User::find($id);
        return view('AdminDashboard.edituser', compact('user'));
    }
    public function EditUser(Request $request, $id){
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        return redirect('showuser')->with('updated', 'User Updated Successfully');
    }
}
