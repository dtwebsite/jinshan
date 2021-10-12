<?php

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
Route::get('/', 'IndexController@index')->name('index');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/products', 'ProductsController@index')->name('products');
Route::get('/process', 'ProcessController@index')->name('process');
Route::get('/gallery', 'GalleryController@index')->name('gallery');
Route::get('/aboutDetail', 'AboutDetailController@index')->name('aboutDetail');
Route::get('/productsDetail/{id}', 'ProductsDetailController@index')->name('productsDetail');
Route::get('/processDetail', 'ProcessDetailController@index')->name('processDetail');
Route::get('/galleryDetail/{id}', 'GalleryDetailController@index')->name('galleryDetail');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::get('/lang/set/{lang}', function ($locale) {
    Session::put('locale', $locale);
    return back();
});

Auth::routes();
Route::get('/admin', function () {
    return view('backend/index');
})->name('backend_index');
Route::group(['middleware' => 'auth'], function () {
	Route::group(['prefix' => 'admin'], function () {
		Route::group(['namespace' => 'backend'], function () {
			Route::get('/dashboard', 'DashboardController@index');
			Route::resource('about', 'AboutController');
			Route::resource('certification', 'CertificationController');
			Route::resource('production_equipment', 'ProductionEquipmentController');
			Route::resource('production_equipment_detail', 'ProductionEquipmentDetailController');
			Route::resource('testing_equipment', 'TestingEquipmentController');
			Route::resource('testing_equipment_detail', 'TestingEquipmentDetailController');
			Route::resource('client', 'ClientController');
			Route::resource('history', 'HistoryController');
			Route::resource('history_img', 'HistoryImgController');
			Route::resource('products', 'ProductsController');
            Route::post('img_sort', 'ProductsController@img_sort');
			Route::post('img_delete', 'ProductsController@img_delete');
			Route::resource('process', 'ProcessController');
            Route::resource('gallery', 'GalleryController');			
            Route::post('gallery_img_sort', 'GalleryController@img_sort');
            Route::post('gallery_img_delete', 'GalleryController@img_delete');
			Route::resource('contact', 'ContactController',['except' => 'store']);
			Route::resource('setting', 'SettingController');
			Route::post('change_password', 'AuthController@change_password');
		});
	});
});
Route::resource('/admin/contact', 'backend\ContactController',['only' => 'store']);