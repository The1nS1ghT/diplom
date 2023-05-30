<?php

use Faker\Guesser\Name;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [\App\Http\Controllers\TourController::class, 'show'])->name('show.tour');
//Route::get('/', [\App\Http\Controllers\TourController::class, 'showCityForSearchTour']);

Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

Route::get('/verify/{id}/{hash}', fn () => 'verify')->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
   return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
   $request->fulfill();

   return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//    $request->user()->sendEmailVerificationNotification();

//    return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::post('/home/user{id}', [App\Http\Controllers\UserController::class, 'updateUser'])->name('update');

//НОВЫЙ МЕНЕДЖЕР

Route::get('/admin/users/create_manager/{id}', [\App\Http\Controllers\AdminController::class, 'createManager'])->name('create.manager');
Route::get('/admin/users/delete_manager/{id}', [\App\Http\Controllers\AdminController::class, 'deleteManager'])->name('delete.manager');


Route::get('/home/user{id}', function () {
   return view('userUpdate');
})->name('userUpdate');

Route::get('/admin', function () {
   if (Gate::check('view-protected-admin')) {
      return view('adminViews/admin');
   }
   return 'Вы не Админ)';
})->middleware('auth')->name('admin');

Route::get(
   '/admin/users',
   [\App\Http\Controllers\AdminController::class, 'getAllUsers']
)->middleware('auth')->name('admin/users');

Route::get('/admin/users/user{id}', [\App\Http\Controllers\AdminController::class, 'getUserDetails'])->middleware('auth')->name('userDetails');

Route::get('/manager', function () {
   if (Gate::check('view-protected-manager')) {
      return view('managerViews/manager');
   }
   return 'Вы не менеджер)';
})->middleware(['auth', 'verified'])->name('manager');

Route::get('/home', function () {
   return view('home');
})->middleware('auth');

//РОУТЫ ДЛЯ СТРАНЫ

Route::get('/countries', [\App\Http\Controllers\CountryController::class, 'show']);
Route::get('manager/countries', [\App\Http\Controllers\CountryController::class, 'show']);
Route::get('/admin/country/create', function () {
   return view('adminViews/showForCreateCountry');
})->middleware('auth')->name('showForCreate.country');

Route::get('/admin/country{id}/update', [\App\Http\Controllers\CountryController::class, 'showForUpdate'])->name('showForUpdate.country');
Route::post('/admin/country/update{id}', [\App\Http\Controllers\CountryController::class, 'update'])->name('update.country');

Route::post('/admin/country/create', [\App\Http\Controllers\CountryController::class, 'create'])->middleware('auth')->name('create.country');
Route::get('/countries/{id}', [\App\Http\Controllers\CountryController::class, 'getCountryDetails'])->name('getCountryDetails');



//РОУТЫ ДЛЯ ГОРОДА

Route::get('/admin/city/create', [\App\Http\Controllers\CityController::class, 'showForCreate'])->name('showForCreate.city');
Route::post('/admin/city/create', [\App\Http\Controllers\CityController::class, 'create'])->name('create.city');
Route::get('/manager/cities', [App\Http\Controllers\CityController::class, 'show'])->name('show.cities');

//РОУТЫ ДЛЯ АЭРОПОРТА

Route::get('/admin/airport/create', [\App\Http\Controllers\AirportController::class, 'showForCreate'])->name('showForCreate.airport');
//Route::get('/manager/airport', [App\Http\Controllers\AirportController::class, 'show'])->name('show.airport');
Route::post('/admin/airport/create', [\App\Http\Controllers\AirportController::class, 'create'])->name('create.airport');


//РОУТЫ ДЛЯ УСЛУГ
Route::get('/manager/services', [\App\Http\Controllers\ServiceController::class, 'show'])->name('show.service');
Route::get('/manager/service/create', [\App\Http\Controllers\ServiceController::class, 'showForCreate'])->name('showForCreate.service');
Route::post('/manager/service/create', [\App\Http\Controllers\ServiceController::class, 'create'])->name('create.service');

//РОУТЫ ДЛЯ НОМЕРОВ
//Route::get('/manager/room/create', [\App\Http\Controllers\RoomController::class, 'showForCreate'])->name('showForCreate.room');
Route::post('/hotel/{id}/create', [\App\Http\Controllers\RoomController::class, 'create'])->name('create.room');
//Route::get('/manager/rooms', [\App\Http\Controllers\RoomController::class, 'show'])->name('show.room');

//Удаление услуг номера
Route::get('/hotel/{id}/{type_room}/delete', [\App\Http\Controllers\HotelController::class, 'showForDelService'])->name('showForDelService.room');
Route::post('/hotel/{id}/{type_room}/delete', [\App\Http\Controllers\RoomController::class, 'deleteService'])->name('deleteService.room');

//Добавление услуг номера

Route::get('/hotel/{id}/{type_room}/added', [\App\Http\Controllers\RoomController::class, 'showForAddService'])->name('showForAddService.room');
Route::post('/hotel/{id}/{type_room}/added', [\App\Http\Controllers\RoomController::class, 'addedService'])->name('addedService.room');


Route::post('/manager/hotel/{id}/create', [\App\Http\Controllers\RoomController::class, 'addService'])->name('addService.room');
Route::get('/hotel/{id}/{room}', [\App\Http\Controllers\RoomController::class, 'show'])->name('show.room');
Route::get('/manager/hotel/{id}/create/room', [\App\Http\Controllers\RoomController::class, 'showForCreateRoom'])->name('showForCreate.room');
Route::get('/hotel/{id}/{type_room}/del', [\App\Http\Controllers\RoomController::class, 'delete'])->name('delete.room');
//Route::get('/hotel/{id}/{room}', [\App\Http\Controllers\RoomController::class, 'show']);


//РОУТЫ ДЛЯ БИЛЕТОВ
Route::get('/manager/tickets', [\App\Http\Controllers\TicketController::class, 'show'])->name('show.tickets');
Route::get('/manager/ticket/create', [\App\Http\Controllers\TicketController::class, 'showForCreate'])->name('showForCreate.ticket');
Route::post('/manager/ticket/create', [\App\Http\Controllers\TicketController::class, 'create'])->name('create.ticket');
Route::get('/manager/ticket{id}', [\App\Http\Controllers\TicketController::class, 'showDetails'])->name('showDetails.ticket');

Route::get('/manager/ticket{id}/update', [\App\Http\Controllers\TicketController::class, 'showForUpdate'])->name('showForUpdate.ticket');
Route::post('/manager/ticket{id}/update', [\App\Http\Controllers\TicketController::class, 'update'])->name('update.ticket');
Route::get('/manager/tickets/{id}', [\App\Http\Controllers\TicketController::class, 'delete'])->name('delete.ticket');
//РОУТЫ ДЛЯ ОТЕЛЯ
Route::get('/hotels', [\App\Http\Controllers\HotelController::class, 'show'])->name('show.hotel');
Route::get('/hotel/{id}', [\App\Http\Controllers\HotelController::class, 'showDetails'])->name('showDetails.hotel');
Route::get('/manager/hotel/create', [\App\Http\Controllers\HotelController::class, 'showForCreate'])->name('showForCreate.hotel');
Route::post('/manager/hotel/create', [\App\Http\Controllers\HotelController::class, 'create'])->name('create.hotel');
Route::get('/manager/hotel/{id}', [\App\Http\Controllers\HotelController::class, 'showForUpdate'])->name('showForUpdate.hotel');
Route::post('/manager/hotel/update/{id}', [\App\Http\Controllers\HotelController::class, 'update'])->name('update.hotel');


//РОУТЫ ДЛЯ ТУРА
Route::get('/tours', [\App\Http\Controllers\TourController::class, 'show'])->name('show.tour');
Route::get('/manager/tour/create', [\App\Http\Controllers\TourController::class, 'showForCreate'])->name('showForCreate.tour');
Route::post('/manager/tour/create', [\App\Http\Controllers\TourController::class, 'create'])->name('create.tour');
Route::get('/tour/{hotel}/{id}', [\App\Http\Controllers\TourController::class, 'showDetails'])->name('showDetails.tour');
Route::get('/tours/{hotel}/{id}/{type_room}', [\App\Http\Controllers\TourController::class, 'showRoomDetails'])->name('showRoomDetails.tour');
//РОУТЫ ДЛЯ ОТЗЫВА

Route::post('/hotel/{id}', [\App\Http\Controllers\HotelController::class, 'createComment'])->name('create.comment');

//ВЫБОР БИЛЕТА
Route::get('/tour/{hotel}/{id}/{type_room}choise', [\App\Http\Controllers\TourController::class, 'choiseTicket'])->name('choiseTicket.tour');

//ПОИСК ТУРА

Route::post('/tours', [\App\Http\Controllers\TourController::class, 'searchTour'])->name('search.tour');
Route::post('/{date1}', [\App\Http\Controllers\TourController::class, 'confirmTicket'])->name('confirmTicket');
