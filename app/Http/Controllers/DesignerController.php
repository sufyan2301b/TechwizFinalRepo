<?php

namespace App\Http\Controllers;

use App\Models\review;
use App\Models\consult;
use App\Models\portfolio;
use Illuminate\Http\Request;
use App\Models\interiorDesigner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DesignerController extends Controller
{
    public function PortfolioView(){
        return view('Designer.uploadportfolio');
    }
    public function InsertPortfolio(Request $request){
        $portfolio = new portfolio();

        $image=$request->file('image');
        $ext= rand().".".$image->getClientOriginalName();
        $image->move("Images/",$ext);
        $portfolio->image=$ext;

        $portfolio->save();
        return redirect()->back()->with("success","Portfolio Uploaded");
    }
    public function Portfolio(){
        $portfolio = portfolio::all();

        return view('Designer.portfolio', compact('portfolio'));
    }
    public function DesignerProfile(){
        $interiorDesigner = DB::select('SELECT * FROM interior_designers JOIN users ON users.id = interior_designers.user_id');
        // return $interiorDesigner;
        return view('designerprofile', compact('interiorDesigner'));
    }
    public function ShowReview($id){
        $id = $id ? $id : auth()->user()->id;
        $review = DB::select('SELECT * FROM reviews WHERE designer_id = '.$id);
        return view('Designer.customerreview', compact('review', 'id'));
    }
    public function InteriorDesignerView(){
        return view('AdminDashboard.addinteriordesigner');
    }
    public function AddDesigner(Request $request){
        $interiorDesigner = new interiorDesigner();

        $interiorDesigner->name = $request->name;
        $interiorDesigner->email = $request->email;
        $interiorDesigner->password = $request->password;
        $interiorDesigner->phone = $request->phone;
        $interiorDesigner->bio = $request->bio;
        $image4=$request->file('profile');
        $ext= rand().".".$image4->getClientOriginalName();
        $image4->move("Images/",$ext);
        $interiorDesigner->profile=$ext;


        $image1=$request->file('image1');
        $ext= rand().".".$image1->getClientOriginalName();
        $image1->move("Images/",$ext);
        $interiorDesigner->image1=$ext;

        $image2=$request->file('image2');
        $ext= rand().".".$image2->getClientOriginalName();
        $image2->move("Images/",$ext);
        $interiorDesigner->image2=$ext;

        $image3=$request->file('image3');
        $ext= rand().".".$image3->getClientOriginalName();
        $image3->move("Images/",$ext);
        $interiorDesigner->image3=$ext;

        $interiorDesigner->save();
        return redirect()->back()->with("success","Designer Added");
    }


    public function viewById($designerid)
    {
        $designerdata = DB::select('SELECT * FROM interior_designers JOIN users ON users.id = interior_designers.user_id WHERE user_id = '.$designerid);
        return view('profiledata' ,compact('designerdata'));
        // return $designerdata;
    }
    public function insertById(Request $request, $designerid)
    {
        $consultation = new consult();
        $consultation->designer_id = $designerid;
        $consultation->customer_name = $request->customer_name;
        $consultation->customer_email = $request->customer_email;
        $consultation->booking_date = $request->booking_date;
        $consultation->booking_time = $request->booking_time;
        $consultation->brief = $request->brief;

        $consultation->save();
        return redirect()->back()->with('consultsend', 'Appointment Sent');
    }
    public function showConsults($id){
        $id = $id ? $id : auth()->user()->id;
        $consults = DB::select('SELECT * FROM consults WHERE designer_id = '.$id);
        return view('Designer.consults', compact('consults', 'id'));

    }

    public function designerIndex(){
        $id = Auth::id();
        return view('Designer.index', compact('id'));
    }

    public function dProfile(){
        $id = Auth::id();
        $interiorDesigner = DB::select('SELECT * FROM interior_designers JOIN users ON users.id = interior_designers.user_id WHERE user_id = '.$id);
        // return $interiorDesigner;
        return view('Designer.profile', compact('interiorDesigner', 'id'));
    }
    public function show(Request $req) {
        // Using Eloquent to fetch designer details
        $uid = $req->post("uid");
      $record = DB::table("interior_designer")->where("id", $uid)->get();
      foreach ($record as $r) {
         $user = $r;
         echo json_encode($user);
      }
    }

    public function update(Request $request, $id) {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string',
            'portfolio_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate images
        ]);

        // Find the designer by ID
        $designer = InteriorDesigner::findOrFail($id);

        // Update the designer's information
        $designer->name = $request->name;
        $designer->email = $request->email;
        $designer->bio = $request->bio;
        $designer->save();

        // Handle portfolio images upload
        if ($request->hasFile('portfolio_images')) {
            foreach ($request->file('portfolio_images') as $image) {
                $path = $image->store('portfolio_images', 'public'); // Store in 'public' disk
                // Assuming there's a PortfolioImage model and relation set up
                $designer->portfolioImages()->create(['url' => $path]);
            }
        }

        return response()->json(['message' => 'Updated successfully!']);
    }

    public function CancelBooking($id){
        $consult = consult::find($id);
        $consult->delete();
        return redirect()->back()->with('cancel', 'Appointment Canceled');
    }

    public function updatePending(int $id){
        $request = consult::find($id);


        $request->status = 'approved';
        $request->save();
        return redirect()->back()->with('status', 'Appointment Approved');


        // $request->status = 'Approved';
        // return redirect()->back()->with('status','Appointment Approved');
    }


    public function FeedbackInsert(Request $request, $id){
        $review = new review();
        $review->designer_id = $id;
        $review->name = $request->name;
        $review->email = $request->email;
        $review->review = $request->message;

        $review->save();
        return redirect()->back()->with('success', 'Review Added');
    }
}
