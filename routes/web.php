<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mycontroller;
use App\Http\Controllers\WebController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\DesignerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// website controller


Route::get('/', [WebController::class, 'WebsiteView'])->name('home');
Route::get('/addtocart/{id}', [WebController::class, 'AddToCart']);
Route::get('/checkout', [WebController::class, 'Cart']);
Route::delete('/deleteproduct', [WebController::class, 'deleteProduct']);
Route::get('search', [WebController::class,'searchData']);

Route::post('/favourites' , [WebController::class,'favourite'])->name('favourites.store');



Route::post('/abc',[mycontroller::class,('insertdata')]);
Route::post('/updprod',[mycontroller::class,('insertproduct')]);
Route::get('/fetch',[mycontroller::class,('getdata')]);

Route::post('/del/{id}',[mycontroller::class,('delrecord')]);
Route::post('/upd/{id}',[mycontroller::class,('updateuser')]);
Route::post('/updaterecord',[mycontroller::class,('update')]);

Route::get('/favouritepage', [WebController::class, 'FavouritePageView']);



// admin panel

Route::get('/showproduct', [mycontroller::class, 'ShowProduct']);
Route::get('/deleteproduct/{id}', [mycontroller::class, 'DeleteProductAdmin']);
Route::get('/editproduct/{id}', [mycontroller::class, 'EditProductView']);
Route::post('/updateproduct/{id}', [mycontroller::class, 'EditProductAdmin']);

Route::get('/showuser', [mycontroller::class,'ShowUser']);
Route::get('/deleteuser/{id}', [mycontroller::class, 'DeleteUser']);
Route::get('/edituser/{id}', [mycontroller::class, 'EditUserView']);
Route::post('/updateuser/{id}', [mycontroller::class, 'EditUser']);

Route::get('/uploaddesign', [DesignController::class, 'UploadDesignView']);
Route::post('/insertdesign', [DesignController::class, 'AddDesign']);

Route::get('/uploadblog', [BlogController::class, 'BlogView']);
Route::post('/insertblog', [BlogController::class, 'AddBlog']);

Route::get('/addinteriordesigner', [DesignerController::class, 'InteriorDesignerView']);
Route::post('/insertdesigner', [DesignerController::class, 'AddDesigner']);



// designer panel

Route::get('/designer/home', [DesignerController::class , 'designerIndex'])->name('designer.home');
Route::get('/uploadportfolio', [DesignerController::class, 'PortfolioView']);
Route::post('/insertportfolio', [DesignerController::class, 'InsertPortfolio']);
Route::get('/showportfolio', [DesignerController::class, 'Portfolio']);
Route::get('/designerprofile', [DesignerController::class, 'DesignerProfile']);
Route::get('/showreview/{id}', [DesignerController::class, 'ShowReview']);



Route::get('/consults/{id}', [DesignerController::class , 'showConsults']);
Route::get('/designer/myprofile/{id}', [DesignerController::class,'dProfile']);
// To display the designer's profile
Route::post('/interior-designers', [DesignerController::class, 'show'])->name('interior_designers.show');

// To update the designer's profile
Route::put('/interior-designers/{id}', [DesignerController::class, 'update'])->name('interior_designers.update');
 // For updating

Route::get('/updatepending/{id}' , [DesignerController::class , 'updatePending']);

 Route::get('/cancel/{id}', [DesignerController::class, 'CancelBooking']);

 Route::post('/feedback/{id}', [DesignerController::class, 'FeedbackInsert']);
// review

Route::post('/uploadreview', [ReviewController::class, 'InsertReview']);
Route::get('/profile/{designerid}', [DesignerController::class, 'viewById']);
Route::post('/profile/{designerid}', [DesignerController::class, 'insertById']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    Route::get('/dashboard', function () {
       if(Auth::User()->role === "customer")
       {
        return redirect()->route('home');
       }
       else if(Auth::User()->role === 'designer'){
        return redirect()->route('designer.home');
       }
       else{
        return view('AdminDashboard.index');
       }
    })->name('dashboard');
});
Route::get('/upload', function () {
    return view('AdminDashboard.uploadproduct');
});
Route::get('/prods',[mycontroller::class,('getproducts')]);
Route::post('/insprod',[mycontroller::class,('insertproducts')]);
