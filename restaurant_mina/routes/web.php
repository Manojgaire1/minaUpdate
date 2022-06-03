<?php

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

//route realted to the mina admin panel
Route::group(['middleware'=>'auth','prefix' => 'admin','namespace'=>'Admin'],function(){
	Route::get('/',function(){
		return redirect()->route('admin.dashboard.index');
	});

	Route::group(['namespace' => 'Dashboard'],function(){
		Route::get('/dashboard',[
			'as'   => 'admin.dashboard.index',
			'uses' => 'DashboardController@index'
		]);
	});

	Route::group(['namespace' => 'Category'],function(){
		Route::get('/menus',[
			'as'   => 'admin.menu.index',
			'uses' => 'CategoryController@index'
		]);
		Route::get('/menus/create',[
			'as'   => 'admin.menu.create',
			'uses' => 'CategoryController@create'
		]);

		Route::get('/menus/{menu}/edit',[
			'as'   => 'admin.category.edit',
			'uses' => 'CategoryController@edit'
		]);

		Route::post('/menus',[
			'as'   => 'admin.menu.store',
			'uses' => 'CategoryController@store'
		]);
		Route::post('/menus/{menu}',[
			'as'   => 'admin.menu.update',
			'uses' => 'CategoryController@update'
		]);
		Route::delete('/menus/{menu}',[
			'as'   => 'admin.menu.destroy',
			'uses' => 'CategoryController@destroy'
		]);
	});

	Route::group(['namespace' => 'Product'],function(){
		Route::get('/products',[
			'as'   => 'admin.product.index',
			'uses' => 'ProductController@index'
		]);
		Route::get('/products/create',[
			'as'   => 'admin.product.create',
			'uses' => 'ProductController@create'
		]);

		Route::get('/products/{product}/edit',[
			'as'   => 'admin.product.edit',
			'uses' => 'ProductController@edit'
		]);
		Route::post('/products',[
			'as'   => 'admin.product.store',
			'uses' => 'ProductController@store'
		]);
		Route::post('/products/{product}',[
			'as'   => 'admin.product.update',
			'uses' => 'ProductController@update'
		]);
		Route::delete('/products/{product}',[
			'as'   => 'admin.product.destroy',
			'uses' => 'ProductController@destroy'
		]);
	});

	Route::group(['namespace' => 'Reservation'],function(){
		Route::get('/reservations',[
			'as'   => 'admin.reservation.index',
			'uses' => 'ReservationController@index'
		]);
		Route::post('/reservations/{reservation}',[
			'as'   => 'admin.reservation.update',
			'uses' => 'ReservationController@update'
		]);
		Route::delete('/reservations/{reservation}',[
			'as'   => 'admin.reservation.destroy',
			'uses' => 'ReservationController@destroy'
		]);
	});

	Route::group(['namespace' => 'Takeout'],function(){
		Route::get('/takeouts',[
			'as'   => 'admin.takeout.index',
			'uses' => 'TakeoutController@index'
		]);
	});

	Route::group(['namespace' => 'Branch'],function(){
		Route::get('/branches',[
			'as'   => 'admin.branch.index',
			'uses' => 'BranchController@index'
		]);
		Route::get('/branches/create',[
			'as'   => 'admin.branch.create',
			'uses' => 'BranchController@create'
		]);

		Route::get('/branches/{branch}/edit',[
			'as'   => 'admin.branch.edit',
			'uses' => 'BranchController@edit'
		]);
		Route::post('/branches',[
			'as'   => 'admin.branch.store',
			'uses' => 'BranchController@store'
		]);
		Route::post('/branches/{branch_id}',[
			'as'   => 'admin.branch.update',
			'uses' => 'BranchController@update'
		]);
		Route::delete('/branches/{branch_id}',[
			'as'   => 'admin.branch.destroy',
			'uses' => 'BranchController@destroy'
		]);
	});

	Route::group(['namespace' => 'SpicyLevel'],function(){
		Route::get('/spicyLevels',[
			'as'   => 'admin.spicyLevel.index',
			'uses' => 'SpicyLevelController@index'
		]);
	});

	//settings

	Route::group(['namespace' => 'Setting'],function(){
		Route::get('/settings',[
			'as'    => 'admin.settings.create',
			'uses'  => 'SettingController@create'
		]);

		Route::post('/settings',[
			'as'    => 'admin.settings.update',
			'uses'  => 'SettingController@update'
		]);
	});
	
});
// route related to the mina frontend
Route::group(['namespace' => 'Frontend'],function(){
	Route::get('/',[
		'as'   => 'frontend.homepage',
		'uses' => 'HomeController@index'
	]);
	Route::get('/about',[
		'as'   => 'frontend.aboutpage',
		'uses' => 'AboutController@index'
	]);
	Route::get('/menu',[
		'as'   => 'frontend.menupage',
		'uses' => 'MenuController@index'
	]);
	Route::get('/gallery',[
		'as'   => 'frontend.gallerypage',
		'uses' => 'GalleryController@index'
	]);
	Route::get('/contact',[
		'as'   => 'frontend.contactpage',
		'uses' => 'ContactController@index'
	]);

	Route::post('/contact',[
		'as'   => 'frontend.save.feedback',
		'uses' => 'ContactController@store'
	]);

	Route::get('/checkout',[
		'as'   => 'frontend.checkoutpage',
		'uses' => 'TakeoutController@index'
	])->middleware('checkCart');

	Route::post('/checkout',[
		'as'   => 'frontend.takeout.store',
		'uses' => 'TakeoutController@store'
	]);

	//change the website language
	Route::get('/changeLanguage',[
		'as'   => 'frontend.changeLanguage',
		'uses' => 'HomeController@changeLanguage'
	]);

	Route::post('/reservations',[
		'as'   => 'frontend.reservations.store',
		'uses' => 'ReservationController@store'
	]);

	//route realted to the cart
	Route::get('/carts/removeItem/{item_id}',[
		'as'   => 'frontend.carts.removeItem',
		'uses' => 'CartController@removeItemFromCart'
	]);

	Route::get('/carts/updateItemQty/{item_id}',[
		'as'   => 'frontend.carts.udpateItemQty',
		'uses' => 'CartController@udpateItemQty'
	]);

	Route::get('/carts/updateItemSpicyLevel/{item_id}',[
		'as'   => 'frontend.carts.updateItemSpicyLevel',
		'uses' => 'CartController@updateItemSpicyLevel'
	]);

	Route::get('/carts/updateItemPcs/{item_id}',[
		'as'   => 'frontend.carts.updateItemPcs',
		'uses' => 'CartController@updateItemPcs'
	]);

	Route::get('/carts/changePickuptime',[
		'as'   => 'frontend.carts.changePickuptime',
		'uses' => 'CartController@changePickupTime'
	]);

	Route::get('/branch/getPickuptime',[
		'as'   => 'frontend.carts.getBranchPickuptime',
		'uses' => 'CartController@getBranchPickupTime'
	]);


	Route::post('/carts',[
		'as'   => 'frontend.carts.add',
		'uses' => 'CartController@addItemToCart'
	]);

	Route::get('/carts/getServiceNaanDetails',[
		'as'   => 'frontend.carts.getServiceNaanDetails',
		'uses' => 'CartController@getServiceNaanDetails'
	]);

	Route::get('/carts/addNewServiceNaan',[
		'as'   => 'frontend.carts.addNewServiceNaan',
		'uses' => 'CartController@addNewServiceNaan'
	]);

	Route::post('/carts/updateServiceNaan',[
		'as'   => 'frontend.carts.updateServiceNaan',
		'uses' => 'CartController@updateServiceNaan'
	]);

	Route::get('/takeout',[
		'as'  => 'frontend.carts.index',
		'uses'=> 'CartController@index'
	]);

	Route::get('/sendOrderEmail',[
		'as'   => 'frontend.sendOrder',
		'uses' => 'TakeoutController@sendOrderEmail',
	]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::any('/register',function(){
// 	return redirect()->route('login');
// });

