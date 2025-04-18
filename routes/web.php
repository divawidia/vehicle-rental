<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\TransmissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleBrandController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehiclePhotoController;
use App\Http\Controllers\Admin\VehicleTypeController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehiclePageBookingController;
use App\Models\Booking;
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

Route::get('/payment/{transaction_code}', [BookingController::class, 'payBooking'])->name('pay-booking');
Route::get('/payment-success/{id}/{transaction_code}', [BookingController::class, 'updateStatusIfSuccess'])->name('update-payment-booking-status');
Route::get('/payment/success/{transaction_code}', [BookingController::class, 'successPayment'])->name('pay-success');

Route::get('/testmail', function (){
    $transaction_code = 'RENT-462105';
    $booking = Booking::where('transaction_code', $transaction_code)->first();
//    $name = 'dipa';
//   \Illuminate\Support\Facades\Mail::to('wiartha2001@gmail.com')->send(new \App\Mail\BookingConfirmationCashMail($booking));
    return new \App\Mail\PayBookingTrfMail($booking);
});

Route::get('/finish-payment', [BookingController::class, 'userPageBooking4'])->name('finish-payment');

Route::get('/about-us', function () {return view('client.pages.about-us');})->name('about-us');

Route::prefix('vehicles')
    ->group(function () {
        Route::get('/', [HomeController::class, 'vehicleList'])->name('vehicle-list');
        Route::get('/{slug}', [HomeController::class, 'vehicleDetail'])->name('vehicle-detail');
        Route::post('/{slug}', [VehiclePageBookingController::class, 'postUserPageBooking1'])->name('book-vehicle.post');
        Route::get('/{slug}/choose-features', [VehiclePageBookingController::class, 'userPageBooking2'])->name('choose-features');
        Route::post('/{slug}/choose-features', [VehiclePageBookingController::class, 'postUserPageBooking2'])->name('choose-features.post');
        Route::get('/{slug}/booking-payment', [VehiclePageBookingController::class, 'userPageBooking3'])->name('vehicle-booking-payment');
        Route::post('/{slug}/booking-payment', [VehiclePageBookingController::class, 'postUserPageBooking3'])->name('vehicle-booking-payment.post');
        Route::get('/{slug}/finish-payment', [VehiclePageBookingController::class, 'userPageBooking4'])->name('vehicle-finish-payment');

    });

Route::post('/api/get-rent-price', [BookingController::class, 'getRentPrice'])->name('get-rent-price');

Route::prefix('blogs')
    ->group(function () {
        Route::get('/', [HomeController::class, 'blogList'])->name('blog-list');
        Route::get('/{slug}', [HomeController::class, 'blogDetail'])->name('blog-detail');
    });

Route::get('/contact-us', function () {
    return view('pages.contact-us');
})->name('contact-us');


Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

Route::get('/booking', [HomeController::class, 'bookingPage'])->name('booking');
Route::get('/booking/invoice-generate-pdf/{id}', [BookingController::class, 'invoicePDF'])->name('invoice-pdf');

Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
        Route::get('/api/fetch-totalRentCountry', [DashboardController::class, 'totalRentCountry'])->name('fetch-totalRentCountry');

        Route::prefix('kategori-kendaraaan')
            ->group(function (){
                Route::get('/', function () {return view('admin.pages.vehicle-category.index');})->name('vehicle-category-index');
                Route::resource('tipe', VehicleTypeController::class);
                Route::resource('transmisi', TransmissionController::class);
                Route::resource('brand', VehicleBrandController::class);
            });

        Route::resource('kendaraan', VehicleController::class);
        Route::post('/kendaraan/photo/upload', [VehicleController::class, 'uploadPhoto'])->name('vehicle-photo-upload');
        Route::post('/kendaraan-desc/photo/upload', [VehicleController::class, 'uploadDescPhoto'])->name('vehicle-desc-photo-upload');
        Route::get('/kendaraan/photo/delete/{id}', [VehicleController::class, 'deletePhoto'])->name('vehicle-photo-delete');
        Route::post('/kendaraan-tambah-fitur', [VehicleController::class, 'addFeature'])->name('tambah-fitur');
        Route::get('/kendaraan-hapus-fitur/{id}', [VehicleController::class, 'deleteFeature'])->name('hapus-fitur');
        Route::post('/kendaraan/{id}', [VehicleController::class, 'storeVehicleDetail'])->name('tambah-detail-kendaraan');
        Route::get('/kendaraan/{id}/vehicle-detail', [VehicleController::class, 'indexVehicleDetail'])->name('index-detail-kendaraan');
        Route::get('/kendaraan/{vehicle_id}/vehicle-detail/{id}/edit', [VehicleController::class, 'editVehicleDetail'])->name('edit-detail-kendaraan');
        Route::put('/kendaraan/vehicle-detail/{id}', [VehicleController::class, 'updateVehicleDetail'])->name('update-detail-kendaraan');
        Route::delete('/kendaraan/{vehicle_id}/vehicle-detail/{id}', [VehicleController::class, 'destroyVehicleDetail'])->name('hapus-detail-kendaraan');

        Route::resource('foto-kendaraan', VehiclePhotoController::class);
        Route::resource('bookings', BookingController::class);
        Route::post('api/fetch-vehicleDetail', [BookingController::class, 'fetchVehicleDetail'])->name('fetch-vehicle-detail');
        Route::get('/bookings/{id}/invoice', [BookingController::class, 'invoice'])->name('booking-invoice');

        Route::prefix('promos')
            ->group(function (){
                Route::get('/', function () {return view('admin.pages.promo.index');})->name('promo-index');
                Route::resource('vouchers', VoucherController::class);
                Route::resource('sales', SaleController::class);
            });

        Route::prefix('blogs')
            ->group(function () {
                Route::resource('tags', TagController::class);
                Route::resource('artikel', BlogController::class);
                Route::post('upload-blog-photo', [BlogController::class, 'uploadPhoto'])->name('blog-photo-upload');
                Route::post('upload-blog-thumbnail', [BlogController::class, 'uploadPhotoThumbnail'])->name('blog-thumbnail-upload');
                Route::get('delete-blog-photo/{id}', [BlogController::class, 'deletePhoto'])->name('blog-photo-delete');
            });

        Route::resource('galleries', GalleryController::class);
        Route::post('/galleries/photo/upload', [GalleryController::class, 'uploadPhoto'])->name('gallery-photo-upload');
        Route::resource('users', UserController::class);
    });
Route::get('/waiting-for-approval', function () {return view('auth.verify');})->name('waiting-for-approval');
Auth::routes();
