<?php


Route::get('/',function(){
	return redirect('/inventory_products');
});


//index
Route::get('/locations', 'LocationController@index');
Route::get('/warehouses', 'WarehouseController@index');
Route::get('/categories', 'CategoryController@index');

Route::get('/materials', 'MaterialController@index');
Route::get('/inventory_material','MaterialViewController@index');

Route::get ('/spare_parts', 'SparePartsController@index');
Route::get('/inventory_spare_parts','SparePartsViewController@index');

Route::get ('/products', 'ProductsController@index');
Route::get('/inventory_products','ProductViewController@index');


Route::get('/material_transactions','MaterialTransactionController@index');
Route::get('/spare_parts_transactions','SparePartsTransactionController@index');
Route::get('/product_transactions','ProductTransactionController@index');


//create
Route::get('/products/create', 'ProductsController@create');
Route::post('/products', 'ProductsController@store');

Route::get('/spare_parts/create', 'SparePartsController@create');
Route::post('/spare_parts', 'SparePartsController@store');

Route::get('/materials/create', 'MaterialController@create');
Route::post('/materials', 'MaterialController@store');

Route::get('/locations/create', 'LocationController@create');
Route::post('/locations', 'LocationController@store');

Route::get('/categories/create', 'CategoryController@create');
Route::post('/categories', 'CategoryController@store');

Route::get('/warehouses/create', 'WarehouseController@create');
Route::post('/warehouses', 'WarehouseController@store');

Route::get('/physical_material/{id}','MaterialInventoryController@create');
Route::post('/physical_material','MaterialInventoryController@store');

Route::get('/physical_spare_parts/{id}','SparePartsInventoryController@create');
Route::post('/physical_spare_parts','SparePartsInventoryController@store');

Route::get('/physical_product/{id}','ProductInventoryController@create');
Route::post('/physical_product','ProductInventoryController@store');

//Shows
Route::get('/material_inventory/{id}','MaterialViewController@show');
Route::get('/spare_parts_inventory/{id}','SparePartsViewController@show');
Route::get('/product_inventory/{id}', 'ProductViewController@show');


//dropdown
Route::get('/material_transactions/create','MaterialTransactionController@create');
Route::get('/material_transactions/internal','MaterialTransactionController@internal');
Route::get('/material_transactions/issue_in','MaterialTransactionController@issue_in');
Route::get('/material_transactions/issue_out','MaterialTransactionController@issue_out');

Route::get('/spare_parts_transactions/create','SparePartsTransactionController@create');
Route::get('/spare_parts_transactions/internal','SparePartsTransactionController@internal');
Route::get('/spare_parts_transactions/issue_in','SparePartsTransactionController@issue_in');
Route::get('/spare_parts_transactions/issue_out','SparePartsTransactionController@issue_out');

Route::get('/product_transactions/create','ProductTransactionController@create');
Route::get('/product_transactions/internal','ProductTransactionController@internal');
Route::get('/product_transactions/issue_in','ProductTransactionController@issue_in');
Route::get('/product_transactions/issue_out','ProductTransactionController@issue_out');
Route::get('/product_transactions_out','ProductTransactionController@issue_out_details');


Route::post('/material_transactions','MaterialTransactionController@store');
Route::post('/spare_parts_transactions','SparePartsTransactionController@store');

Route::post('/product_issue_in','ProductTransactionController@store_issue_in');
Route::post('/product_issue_out','ProductTransactionController@store_issue_out');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
