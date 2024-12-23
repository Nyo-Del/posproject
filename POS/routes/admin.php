<?php

use App\Models\categorie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Addnewadmin;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Admin\admincontroller;
use App\Http\Controllers\Admin\Profilecontroller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Models\Payment;

Route::group(['prefix'=>'admin','middleware'=>'admin'] , function(){

    Route::get('home',[admincontroller::class,'adminHome'])->name('adminHome');

    //category
    Route::group(['prefix'=>'category'],function(){
     Route::get('list',[CategorieController::class,'list'])->name('category#list');
     Route::post('create',[CategorieController::class,'create'])->name('createcategory');
     Route::get('delete/{id}',[CategorieController::class,'delete'])->name('categorydelete');
     Route::get('update/{id}',[CategorieController::class,'upatepage'])->name('categoryupdate');
     Route::post('update/{id}',[CategorieController::class,'update'])->name('update');
     Route::get('back',[CategorieController::class,'back'])->name('back');

    });

    //Profile
    Route::group(['prefix'=>'profile'],function(){
     Route::get('changepassword',[Profilecontroller::class,'changepassword'])->name('changepassword');
     Route::post('changepasswordp2',[Profilecontroller::class,'changep'])->name('changep');
     Route::get('/profileinfo',[Profilecontroller::class,'profilepage'])->name('profile');
     Route::post('/updatephoto',[Profilecontroller::class,'upload'])->name('uploadphoto');

     //Edit
     Route::get('/editinfo',[Profilecontroller::class,'editpage'])->name('editinfo');
     Route::post('/editinfo',[Profilecontroller::class,'edit'])->name('edit');
    });

    //addnewadmin
    Route::group(['middleware'=>'superadmin'],function(){
        Route::get('addnewadmin',[Addnewadmin::class,'addpage'])->name('addnew');
        Route::post('/addnewadmin',[Addnewadmin::class,'add'])->name('addingprocess');
        Route::get('/admid&List',[Addnewadmin::class,'listpage'])->name('admin#list');
        Route::get('/User&List',[Addnewadmin::class,'Userlistpage'])->name('user#list');
        Route::get('ban/{id}',[Addnewadmin::class,'delete'])->name('admin#delete');
    });


    //Payment
    Route::group(['prefix'=>'Payment'],function(){
        Route::get('addpayment',[PaymentController::class,'paymentpage'])->name('page');
        Route::post('addpayment',[PaymentController::class,'paymentadd'])->name('add');
        Route::get('allpayment/',[PaymentController::class,'allpayment'])->name('allpayment');
        Route::get('deletepayment/{id}',[PaymentController::class,'paymentdelete'])->name('delete');
        Route::get('updatepayment/{id}',[PaymentController::class,'paymentupdatepage'])->name('update#page');
        Route::post('updatepayment/{id}',[PaymentController::class,'paymentedit'])->name('payment#edit');

    });

    //Product
    Route::group(['prefix'=>'Product'],function(){
        Route::get('/NewProductCreate',[ProductController::class,'Pcreatepage'])->name('Product#create');
        Route::post('/NewProductCreate',[ProductController::class,'Pcreate'])->name('P#create');
        Route::get('/ProductListPage/{amt?}',[ProductController::class,'Plistpage'])->name('P#page');
        Route::get('/deleteproduct/{id}',[ProductController::class,'Pdelete'])->name('P#delete');
        Route::get('seemoreproduct/{id}',[ProductController::class,'Pseemore'])->name('P#seemore');
        Route::get('Updatepage/{id}',[ProductController::class,'Pupdatepage'])->name('P#updatepage');
        Route::post('update/{id}',[ProductController::class,'Pupdated'])->name('P#updated');

    });

    Route::group(['prefix'=>'Order'],function(){
        Route::get('ordertable/{order_code}',[OrderController::class,'orderview'])->name('O#view');
        Route::get('orderboard/',[OrderController::class,'orderboard'])->name('O#order');
        Route::get('changestatus',[OrderController::class,'changest'])->name('O#changest');
        Route::get('comfirmorder/',[OrderController::class,'confirm'])->name('O#confirm');
        Route::get('rejectOrder/',[OrderController::class,'reject'])->name('O#reject');





    });




} );
