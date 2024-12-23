<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\User\password;
use App\Http\Controllers\User\Profilecontroller;
use App\Http\Controllers\User\usercontroller;
use App\Http\Controllers\User\userproductscontroller;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'user','middleware'=>'user'] , function(){

    //Home
    Route::get('home/{id?}',[usercontroller::class,'userHome'])->name('userHome');


    //review section
    Route::post('review/{id}',[CommentController::class,'userreview'])->name('review');
    Route::get('delete/{id}',[CommentController::class,'delete'])->name('commentdelete');

    //rating
    Route::post('rating/{id}',[RatingController::class,'rating'])->name('U#rating');



    //add to cart
    Route::post('addtocart/{id}',[userproductscontroller::class,'addtoCart'])->name('addtocart');
    Route::group(['prefix'=>'Cart'],function(){
    Route::get('cart/{id}',[CartController::class,'cartview'])->name('cart');
    Route::get('deletecart/{cid}',[CartController::class,'deletecart'])->name('deletecart');
    });


    //payment
    Route::get('cart/temp',[userproductscontroller::class,'carttemp'])->name('carttemp');
    Route::get('payment/',[PaymentController::class,'payment'])->name('payment');
    Route::post('order/',[PaymentController::class,'order'])->name('order');
    Route::get('orderlist/{id}',[PaymentController::class,'orderlist'])->name('orderlist');


    //Productdetails
    Route::group(['prefiex'=>'Productdetails'],function(){
        Route::get('details/{id}',[userproductscontroller::class,'userpdetails'])->name('User#Pdetails');
    });


    //contactpage
    Route::get('contactpage/',[ContactController::class,'contentpage'])->name('usercontact');
    Route::post('contactus/{id}',[ContactController::class,'contentus'])->name('usercontactus');


    //user dashboard
    Route::group(['prefix'=>'profile'],function(){
        Route::get('userprofile',[Profilecontroller::class,'userprofile'])->name('U#profile');
        Route::post('updateuserprofile/{id}',[Profilecontroller::class,'userupdate'])->name('userupdateProfile');
        Route::get('changepassword',[password::class,'changepasswordpg'])->name('U#change');
        Route::post('changedpassword/{id}',[password::class,'changepassword'])->name('U#password');
        Route::get('orderInformation/{id}',[userproductscontroller::class,'order'])->name('U#order');
        Route::get('usercart/{id}',[CartController::class,'usercartview'])->name('U#cart');
    });

});
