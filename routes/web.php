<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/admin',[HomeController::class,'adminpage'])->name('admin.page')->middleware('isAdmin');


//Admin Slider

Route::get('/Admin/slider',[AdminSliderController::class,'sliderhome'])->name('adminslder.home');
Route::post('/Admin/slider/post',[AdminSliderController::class,'sliderpost'])->name('adminslider.post');
Route::get('/Admin/slider/show',[AdminSliderController::class,'slidershow'])->name('adminslider.show');
Route::get('/Amdin/slider/update/page/{id}',[AdminSliderController::class,'sliderupdatepage'])->name('adminslider.updatepage');
Route::post('Admin/slider/update/post/{id}',[AdminSliderController::class,'sliderupdate'])->name('adminslider.update');

Route::get('Admin/slider/active/{id}',[AdminSliderController::class,'active'])->name('adminslider.active');
Route::get('Admin/slider/unactive/{id}',[AdminSliderController::class,'unactive'])->name('adminslider.unactive');
Route::get('Amin/slider/delete/{id}',[AdminSliderController::class,'delete'])->name('adminslider.delete');

//About

Route::get('/Admin/About',[AboutController::class,'abouthome'])->name('adminabout.home');
Route::post('/Admin/About/post',[AboutController::class,'aboutpost'])->name('adminabout.post');
Route::get('/Admin/About/show',[AboutController::class,'aboutshow'])->name('adminabout.show');

Route::get('/Admin/About/update/page/{id}',[AboutController::class,'aboutupdatepage'])->name('adminabout.updatepage');
Route::post('/Amin/About/update/post/{id}',[AboutController::class,'aboutupdate'])->name('adminabout.update');
Route::get('/Admin/About/delete/{id}',[AboutController::class,'delete'])->name('adminabout.delete');

//Service

Route::get('/Admin/Service',[ServiceController::class,'servicehome'])->name('adminservice.home');
Route::post('/Admin/Service/post',[ServiceController::class,'servicepost'])->name('adminservice.post');
Route::get('/Admin/Service/show',[ServiceController::class,'servicshow'])->name('adminservice.show');
Route::get('/Admin/Service/update/page/{id}',[ServiceController::class,'serviceupdatepage'])->name('adminservice.updatepage');
Route::post('/Admin/Service/update/post/{id}',[ServiceController::class,'serviceupdate'])->name('adminservice.update');

Route::get('/Admin/Service/active/{id}',[ServiceController::class,'active'])->name('adminservice.active');
Route::get('/Admin/Service/unactive/{id}',[ServiceController::class,'unactive'])->name('adminservice.unactive');

Route::get('/Admin/Service/delete/{id}',[ServiceController::class,'delete'])->name('adminservice.delete');

//Product

Route::get('/Admin/Product',[ProductController::class,'producthome'])->name('adminproduct.home');
Route::post('/Admin/Product/post',[ProductController::class,'productpost'])->name('adminproduct.post');
Route::get('/Admin/Product/show',[ProductController::class,'productshow'])->name('adminproduct.show');
Route::get('/Admin/Product/update/page/{id}',[ProductController::class,'productupdatepage'])->name('adminsproduct.updatepage');
Route::post('/Admin/Product/update/post/{id}',[ProductController::class,'productupdate'])->name('adminproduct.update');

Route::get('/Admin/Product/active/{id}',[ProductController::class,'active'])->name('adminproduct.active');
Route::get('/Admin/Product/unactive/{id}',[ProductController::class,'unactive'])->name('adminproduct.unactive');

Route::get('/Admin/Product/delete/{id}',[ProductController::class,'delete'])->name('adminproduct.delete');

//tem member

Route::get('/Admin/team',[TeamController::class,'teamhome'])->name('adminteam.home');
Route::post('/Admin/team/post',[TeamController::class,'teampost'])->name('adminteam.post');
Route::get('/Admin/team/show',[TeamController::class,'teamshow'])->name('adminteam.show');
Route::get('/Admin/team/update/page/{id}',[TeamController::class,'teamupdatepage'])->name('adminteam.updatepage');
Route::post('/Admin/team/update/post/{id}',[TeamController::class,'teamupdate'])->name('adminteam.update');

Route::get('/Admin/team/active/{id}',[TeamController::class,'active'])->name('adminteam.active');
Route::get('/Admin/team/unactive/{id}',[TeamController::class,'unactive'])->name('adminteam.unactive');

Route::get('/Admin/team/delete/{id}',[TeamController::class,'delete'])->name('adminteam.delete');

//Blog

Route::get('/Admin/blog',[BlogController::class,'bloghome'])->name('adminblog.home');
Route::post('/Admin/blog/post',[BlogController::class,'blogpost'])->name('adminblog.post');
Route::get('/Admin/blog/show',[BlogController::class,'blogshow'])->name('adminblog.show');
Route::get('/Admin/blog/update/page/{id}',[BlogController::class,'blogupdatepage'])->name('adminblog.updatepage');
Route::post('/Admin/blog/update/post/{id}',[BlogController::class,'blogupdate'])->name('adminblog.update');

Route::get('/Admin/blog/active/{id}',[BlogController::class,'active'])->name('adminblog.active');
Route::get('/Admin/blog/unactive/{id}',[BlogController::class,'unactive'])->name('adminblog.unactive');

Route::get('/Admin/blog/delete/{id}',[BlogController::class,'delete'])->name('adminblog.delete');
