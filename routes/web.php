<?php

use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\TransmissionController;
use App\Http\Controllers\Admin\VehicleBrandController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehiclePhotoController;
use App\Http\Controllers\Admin\VehicleTypeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BookingController::class, 'userPageBooking1'])->name('home');
Route::post('/', [BookingController::class, 'postUserPageBooking1'])->name('home.post');

Route::get('/choose-vehicle', [BookingController::class, 'userPageBooking2'])->name('choose-vehicle');
Route::post('/choose-vehicle', [BookingController::class, 'postUserPageBooking2'])->name('choose-vehicle.post');

Route::get('/booking-payment', [BookingController::class, 'userPageBooking3'])->name('booking-payment');
Route::post('/booking-payment', [BookingController::class, 'postUserPageBooking3'])->name('booking-payment.post');

Route::get('/finish-payment', [BookingController::class, 'userPageBooking4'])->name('finish-payment');

Route::get('/about-us', function () {
    return view('pages.about-us');
})->name('about-us');

Route::get('/vehicles', [HomeController::class, 'vehicleList'])->name('vehicle-list');

Route::get('/blog', function () {
    return view('vendor.binshopsblog.index');
})->name('blog');

Route::get('/vehicles/{vehicle}', [HomeController::class, 'vehicleDetail'])->name('vehicle-detail');

Route::get('/contact-us', function () {
    return view('pages.contact-us');
})->name('contact-us');


Route::get('/gallery', function () {
    return view('pages.gallery');
})->name('gallery');

Route::get('/booking', function () {
    return view('pages.booking');
})->name('booking');

Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/', function () {return view('pages.admin.dashboard');})->name('admin-dashboard');
        Route::prefix('kategori-kendaraaan')
            ->group(function (){
                Route::get('/', function () {return view('pages.admin.vehicle-category.index');})->name('vehicle-category-index');
                Route::resource('tipe', VehicleTypeController::class);
                Route::resource('transmisi', TransmissionController::class);
                Route::resource('brand', VehicleBrandController::class);
            });
        Route::resource('kendaraan', VehicleController::class);
        Route::post('/kendaraan/photo/upload', [VehicleController::class, 'uploadPhoto'])->name('vehicle-photo-upload');
        Route::get('/kendaraan/photo/delete/{id}', [VehicleController::class, 'deletePhoto'])->name('vehicle-photo-delete');

        Route::resource('foto-kendaraan', VehiclePhotoController::class);
        Route::resource('bookings', BookingController::class);
        Route::get('/bookings/{id}/invoice', [BookingController::class, 'invoice'])->name('booking-invoice');

        Route::resource('blogs', BlogController::class);
        Route::post('upload-blog-photo', [BlogController::class, 'uploadPhoto'])->name('blog-photo-upload');
        Route::post('upload-blog-thumbnail', [BlogController::class, 'uploadPhotoThumbnail'])->name('blog-thumbnail-upload');
        Route::get('delete-blog-photo/{id}', [BlogController::class, 'deletePhoto'])->name('blog-photo-delete');

        Route::resource('tags', TagController::class);
    });
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout-admin');
Auth::routes();
