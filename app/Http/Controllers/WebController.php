<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\design;
use App\Models\favourite;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function WebsiteView(){
        $products = product::all();
        $design = design::all();
        $blog = blog::all();
        $favouriteDesigns = favourite::where('user_id', Auth::id())
                                 ->pluck('design_id')
                                 ->toArray();
        return view('index', compact('products', 'design', 'blog', 'favouriteDesigns'));
    }
    public function AddToCart($id){
        if(Auth::check()){
            $inventory = product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }
        else{
            $cart[$id] = [
                "name" => $inventory->name,
                "description" => $inventory->description,
                "quantity" => 1,
                "price" => $inventory->price,
                "category" => $inventory->category,
                "image" => $inventory->image,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('added', 'Item has been added to cart!');
        }else{
            return redirect()->route('login')->with('error', 'You need to login before purchasing anything');
        }
    }




    public function Cart(){
        return view('checkout');
    }
    public function deleteProduct(Request $request){
        if($request->id){
            $cart = session()->get('cart');
            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Item successfully deleted.');
        }
    }


    public function searchData(Request $request){
        $product = $request->input('products');
        $design = design::all();
        $blog = blog::all();
        $favouriteDesigns = favourite::where('user_id', Auth::id())
                                 ->pluck('design_id')
                                 ->toArray();
        $products = DB::table('products')->where('category', 'LIKE', '%'.$product.'%')->get();
        return view('index', compact('products', 'design' , 'blog', 'favouriteDesigns'));
    }

    public function favourite(Request $request){
         // Ensure the user is authenticated
         if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate the incoming request
        $request->validate([
            'design_id' => 'required|exists:designs,id',
        ]);

        // Check if the design is already in the user's favourites
        $favourite = Favourite::where('user_id', Auth::id())
                              ->where('design_id', $request->design_id)
                              ->first();

        if ($favourite) {
            return response()->json(['message' => 'Already in favourites']);
        }

        // Create a new favourite
        Favourite::create([
            'user_id' => Auth::id(),
            'design_id' => $request->design_id,
        ]);

        return response()->json(['message' => 'Added to favourites']);
    }
    public function FavouritePageView(){
        $id = Auth::id();
        $favourite = DB::select('select designs.image, designs.category from favourites join designs on designs.id = favourites.design_id where user_id = '.$id);
        // return $favourite;
        return view('favourites', compact('favourite'));
    }
}
