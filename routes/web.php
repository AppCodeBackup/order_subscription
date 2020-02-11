<?php
header('Access-Control-Allow-Origin: *');



Route::get('/homeadmin', 'AppController@index')->name('homeadmin');
Route::post('/find_product_title', 'AppController@find_product_title')->middleware(['auth.shop'])->name('find_product_title');
Route::get('/find_product', 'AppController@find_product_title')->middleware(['auth.shop'])->name('find_product');
Route::Post('/SaveData', 'AppController@SaveData')->middleware(['auth.shop'])->name('SaveData');
Route::get('GetProductDiscountSet', 'AppController@GetProductDiscountSet')->name('GetProductDiscountSet');

Route::get('/SubscriptionDetailsByID','AppController@SubscriptionDetailsByID');

Route::post('GetCartPrices', 'ApiController@GetCartPrices')->name('GetCartPrices');
Route::get('GetSubscriptionProducts', 'AppController@GetSubscriptionProducts');
Route::get('ModalView', 'AppController@ModalView');


Route::get('customer_pricing.js', 'ApiController@customer_pricing')->name('customer_pricing');
Route::get('csp_install_check.js', 'ApiController@csp_install_check')->name('csp_install_check');
Route::get('cspqb.js', 'ApiController@cspqb')->name('cspqb');
Route::get('GetProductDiscount', 'ApiController@GetProductDiscount')->name('GetProductDiscount');
Route::get('get_qb_discount_banner_data', 'ApiController@get_qb_discount_banner_data')->name('get_qb_discount_banner_data');

//Admin Route
Route::post('create_subsc_group_data', 'SubscriptionSyncController@create_subsc_group_data')->name('create_subsc_group_data');
Route::get('processSubscriptionPlan', 'SubscriptionSyncController@processSubscriptionPlan')->name('processSubscriptionPlan');
Route::get('/GetProducts', 'AdminApiController@GetProducts')->name('GetProducts');
Route::get('/customSubsc', 'SubscriptionApiController@index')->name('customSubsc');

Route::post('/post-subscription','SubscriptionApiController@postsubscription')->name('post-subscription');
Route::post('/DeleteGroup','SubscriptionSyncController@DeleteGroup');
Route::get('/DeleteGroupFromJob','SubscriptionSyncController@DeleteGroupFromJob');



Route::post('/GetPaymentMethodFromCustomer','SubscriptionApiController@GetPaymentMethodFromCustomer')->name('GetPaymentMethodFromCustomer');

//Shopify Api routes
Route::post('/getCustomerOrders','SubscriptionApiController@getCustomerOrders')->name('getCustomerOrders');


//View Routes

Route::get('/cart_data', function () {
    return response('Hello, world!')->withHeaders(['Content-Type' => 'application/liquid']);
 });
//Route::get('/cart_data', 'ApiController@cart_data')->name('cart_data');
//Route::post('/cart_data', 'ApiController@cart_data')->name('cart_data');
Route::post('/swapprd','SubscriptionApiController@swapprd')->name('swapprd');
Route::get('/group/{groupid}', 'ApiController@group')->name('group');
Route::get('createmeta', 'ApiController@createmeta')->name('createmeta');
Route::get('translations', 'ApiController@translations')->name('translations');
Route::get('css', 'ApiController@css')->name('css');
Route::get('recurring_cart_settings','ApiController@recurring_cart_settings')->name('recurring_cart_settings');
Route::get('SubscriptionGroups', 'AppController@SubscriptionGroups')->name('SubscriptionGroups');
Route::get('SubScriptionCustomers', 'AppController@SubScriptionCustomers')->name('SubScriptionCustomers');
Route::get('DiscountCodes', 'AppController@DiscountCodes')->name('DiscountCodes');
Route::get('CreateDiscountCode', 'AppController@CreateDiscountCode')->name('CreateDiscountCode');
Route::get('create-subscription-set', 'AppController@create_subscription_set')->name('create-subscription-set');


Route::post('CreateDraftOrder', 'ApiController@CreateDraftOrder')->name('CreateDraftOrder');

Route::post('draft-ordercheckout/recurring/{cartdata}', 'AppController@CreateDraft')->name('group');

Route::get('GetCountyList', 'ApiController@GetCountyList');
Route::get('GetShopifyCustomer', 'ApiController@GetShopifyCustomer');
Route::get('GetStateList', 'ApiController@GetStateList');

Route::post('/UploadCanvas','ApiController@UploadCanvas')->name('UploadCanvas');
