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

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localize']], function () {
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

    Route::prefix('admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->middleware(['auth'])->group(function() {
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('api/fetch-totalRentCountry', [DashboardController::class, 'totalRentCountry'])->name('fetch-totalRentCountry');

        Route::resource('vehicle-types', VehicleTypeController::class);
        Route::resource('vehicle-transmissions', TransmissionController::class);
        Route::resource('vehicle-brands', VehicleBrandController::class);

        Route::resource('vehicles', VehicleController::class);
        Route::prefix('vehicles')->name('vehicles.')->group(function (){
            Route::resource('photos', VehiclePhotoController::class);
        });

        Route::resource('bookings', BookingController::class);
        Route::prefix('bookings')->name('bookings.')->group(function (){
            Route::get('calendar', [BookingController::class, 'index'])->name('calendar');
            Route::get('{booking}/invoice', [BookingController::class, 'invoice'])->name('invoice');
        });

        Route::resource('vouchers', VoucherController::class);
        Route::resource('discounts', SaleController::class);

        Route::resource('tags', TagController::class);
        Route::resource('articles', BlogController::class);
        Route::prefix('articles/photos')->name('articles.photos')->group(function (){
            Route::post('upload', [BlogController::class, 'uploadPhoto'])->name('upload');
            Route::get('delete/{id}', [BlogController::class, 'deletePhoto'])->name('delete');
        });

        Route::resource('galleries', GalleryController::class);
        Route::resource('users', UserController::class);
        });
    Route::get('waiting-for-approval', function () {return view('auth.verify');})->name('waiting-for-approval');
});



Auth::routes();
