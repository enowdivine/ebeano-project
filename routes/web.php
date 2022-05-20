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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'PagesController@index')->name('home');
Route::get('/test', 'SpeedafController@test')->name('test');
Route::get('/user', 'UsersController@index');

Route::get('/marketplace', 'MarketPlaceController@index');
Route::get('/login/{type}', 'PagesController@login')->name('login');
Route::get('/register/{type}', 'PagesController@register')->name('register');
Route::get('/login', 'PagesController@login')->name('login');
Route::get('/register', 'PagesController@register')->name('register');
Route::post('/login/cart', 'PagesController@cart_login')->name('cart.login.submit');
Route::get('/test-api', 'InterswitchController@test');
Route::get('/interswitch/sandbox/biller/{id}', 'InterswitchController@is_sandbox_test');

Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::post('/payment/approve/store', 'PaymentController@ApprovePayment')->name('payment.verify');
Route::get('/payment/cancel/{id}', 'PaymentController@cancelPayment')->name('payment.cancel');
Route::get('/payment/view/{id}', 'PaymentController@viewPayment')->name('payment.show');

Route::get('/terms', 'PagesController@terms')->name('terms');
Route::get('/help', 'PagesController@help')->name('help');
Route::get('/faq', 'PagesController@faq')->name('faq');
Route::get('/privacy-policy', 'PagesController@privacy_policy')->name('privacy');
Route::get('/contact/send_mail', 'PagesController@sendContactMail')->name('user.contact');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/about-us', 'PagesController@about_us')->name('about');

/*============== User Password Reset Route list ===========================*/
Route::get('user-password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('user-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('user-password/reset/{token}', 'ResetPasswordController@showResetForm')->name('user.password.reset');
Route::post('user-password/reset', 'ResetPasswordController@reset');

/*============== Expressbills Route list ===========================*/
Route::get('/expressbills', 'ExpressBillsController@index');
Route::post('/get-services', 'ExpressBillsController@ajaxServicesBiller')->name('get-services');
Route::post('/validate-customer', 'ExpressBillsController@ajaxValidateCustomer')->name('validate-customer');
Route::post('/send-purchase-request', 'ExpressBillsController@sendPurchaseRequest')->name('send-purchase-request');

Route::get('ref/register', 'PagesController@generateRefCode')->name('generate.refCode');
Route::post('ref/store', 'PagesController@storeRefCode')->name('store.refCode');
Route::get('ref/success', 'PagesController@generateSuccess')->name('generate.success');

Route::any('ref/statistics', 'PagesController@refStatistics')->name('show.refUsers');

Route::post('/verify/account', 'PagesController@verify_account')->name('verify.account');
// artisans
Route::get('/artisans', 'ArtisansController@index');
Route::get('/bids', 'ArtisansController@index')->name('bids');

// bookings
Route::get('/bookings', 'BookingsController@index');
// real estate
Route::get('/estate', 'RealEstateController@index');
Route::get('/estate/property/{slug}', 'RealEstateController@showEstate')->name('estate.show');
Route::get('/estate/filter/{slug}', 'RealEstateController@filterEstate')->name('estate.filter');
Route::get('/estate/search', 'RealEstateController@searchEstate')->name('estate.search');

// eforms
Route::get('/eforms', 'InstituteFormsController@index');
Route::any('/eforms/filter/{slug}', 'InstituteFormsController@filterForm')->name('filter.eforms');
Route::post('/eforms/filter', 'InstituteFormsController@filterForm')->name('filter.eforms.post');
Route::post('/eforms/process/create-transaction', 'InstituteFormsController@createTranxProcessEform')->name('eforms.process.create-transaction');
Route::post('/eforms/process/create-payment', 'InstituteFormsController@createTranxPayment')->name('eforms.process.create-payment');
Route::post('/eforms/send-purchase-request', 'InstituteFormsController@sendFormPurchaseRequest')->name('send-form-purchase-request');
Route::get('/view/institute/eforms/{reference}', 'InstituteFormsController@viewEform')->name('registrar.view.eforms');
Route::get('/eforms/start-complete/institute/{reference}/{orderID}/{hash}', 'InstituteFormsController@startFillingEform')->name('registrar.start-complete.eforms');
Route::post('/eforms/start-complete/institute/{reference}/{orderID}/{hash}', 'InstituteFormsController@startFillingEformPost')->name('registrar.start-complete.eforms');
Route::get('/eforms/preview-complete/institute/{reference}/{orderID}/{hash}', 'InstituteFormsController@previewSubmittedEform')->name('registrar.preview-complete.eforms');
Route::get('/eforms/thank-you/institute/{reference}/{orderID}/{hash}', 'InstituteFormsController@thankYouEform')->name('registrar.thank-you.eforms');

Route::get('/room-list', 'BookingsController@roomList')->name('room-list');
Route::get('/room-details/{id}', 'BookingsController@roomDetails')->name('room_details');
Route::get('/room-details/{id}/check-available', 'BookingsController@checkAvailableRoom')->name('check_available_room');
Route::post('/booking/{id}', 'BookingsController@booking')->name('booking');
Route::post('/book-flight/{id}', 'BookingsController@bookFlight')->name('book.flight');
Route::get('/checkout', 'BookingsController@checkout')->name('checkout');
Route::get('/confirm-checkout', 'BookingsController@confirmCheckout')->name('confirm-checkout');
Route::post('/apply-coupon', 'BookingsController@applyCoupon')->name('apply-coupon');
Route::get('/select-gateway', 'BookingsController@selectGateway')->name('select_gateway');
Route::get('/insert-reservation/{gateway_id}', 'BookingsController@insertReservation')->name('insert_reservation');
Route::get('/payment-preview', 'BookingsController@paymentPreview')->name('payment.preview');

Route::post('payment/confirm', 'BookingsController@paymentConfirm')->name('payment.confirm');
Route::get('reservation/success', 'BookingsController@reservationSuccess')->name('reservation.success');

Route::get('/flight-list', 'BookingsController@flightList')->name('flight-list');
Route::get('/flight-details/{id}', 'BookingsController@flightDetails')->name('flight_details');
Route::get('/flight-details/{id}/check-available', 'BookingsController@checkAvailableSeat')->name('check_available_seat');

//Market place
Route::get('/marketplace', 'MarketPlaceController@index');
Route::get('/all_markets', 'MarketPlaceController@all_mart');
Route::post('/filter_markets', 'MarketPlaceController@filter_mart')->name('mart.filter');
Route::post('/filter_stores', 'MarketPlaceController@filter_store')->name('store.filter');
Route::post('/get-marts-by-states', 'MarketPlaceController@ajaxStatesMarts')->name('get-marts');
Route::post('/get-stores-by-marts', 'MarketPlaceController@ajaxMartsStores')->name('get-stores');
Route::post('/marketplace/section/featured', 'MarketPlaceController@load_featured_section')->name('mart.section.featured');
Route::post('/marketplace/section/top_selling', 'MarketPlaceController@load_top_selling_section')->name('mart.section.top_selling');
Route::post('/marketplace/section/home_categories', 'MarketPlaceController@load_home_categories_section')->name('mart.section.home_categories');
Route::get('/eb-marts/{slug}', 'MarketPlaceController@single_mart')->name('mart');


Route::get('/search', 'PagesController@product_search')->name('search');
Route::post('search/ajax_search', 'PagesController@ajax_search')->name('search.ajax');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/nav-cart-items', 'CartController@updateNavCart')->name('cart.nav_cart');
Route::post('/cart/show-cart-modal', 'CartController@showCartModal')->name('cart.showCartModal');
Route::post('/cart/addtocart', 'CartController@addToCart')->name('cart.addToCart');
Route::post('/cart/removeFromCart', 'CartController@removeFromCart')->name('cart.removeFromCart');
Route::post('/cart/updateQuantity', 'CartController@updateQuantity')->name('cart.updateQuantity');
Route::post('/cart/addShipping', 'CartController@addShipping')->name('cart.addShipping');

Route::middleware('auth')->group(function (){
    Route::get('/user/profile/edit', 'UsersController@user_edit_profile')->name('user.edit_profile');
    Route::get('/user/profile/change_password', 'UsersController@user_change_pass')->name('user.change_pass_page');
    Route::post('business_info/update', 'SellerController@sellerUpdateInfo')->name('seller.updateInfo');
    Route::post('/user/profile/update', 'UsersController@update_profile')->name('user.update_profile');
    Route::post('/user/password/change', 'UsersController@change_pass')->name('user.change_password');
    Route::get('orders', 'OrderController@customer')->name('orders');
    Route::post('/seller/update-profile', 'PagesController@seller_update_profile')->name('seller.profile.update');

    Route::resource('purchase_history','PurchaseHistoryController');
    Route::post('/purchase_history/details', 'PurchaseHistoryController@purchase_history_details')->name('purchase_history.details');
    Route::get('/purchase_history/destroy/{id}', 'PurchaseHistoryController@destroy')->name('purchase_history.destroy');

    Route::post('wishlists/store','WishlistController@store')->name('wishlists.store');
    Route::get('wishlists','WishlistController@index')->name('wishlists.index');

    Route::post('/wishlists/remove', 'WishlistController@remove')->name('wishlists.remove');

    Route::get('/user/wallet', 'WalletController@index')->name('wallet.index');
    Route::post('user/wallet/recharge', 'WalletController@recharge')->name('wallet.recharge');
    Route::post('user/wallet/withraw', 'WalletController@withdrawBalance')->name('withdraw.balance');

    Route::resource('support_ticket','SupportTicketController');
    Route::post('support_ticket/reply','SupportTicketController@seller_store')->name('support_ticket.seller_store');

    Route::post('/customer_packages/purchase', 'CustomerPackageController@purchase_package')->name('purchase_package');
    Route::resource('customer_products', 'CustomerProductController');
    Route::post('/customer_products/published', 'CustomerProductController@updatePublished')->name('customer_products.published');
    Route::post('/customer_products/status', 'CustomerProductController@updateStatus')->name('customer_products.update.status');
    
    // artisans
    Route::prefix('artisans')->group(function(){
        Route::middleware(['subscribed','profile.complete'])->group(function(){
            Route::get('/recent-job', 'ArtisansController@recentJob')->name('recent-job');
            Route::get('/create-job', 'ArtisansController@createJob')->name('create-job');
            Route::post('/create-job-post', 'ArtisansController@createJobPost')->name('create-job-post');
            Route::get('/my-job', 'ArtisansController@myJob')->name('my-job');
            Route::get('/bid-project/{id}/{slug}', ['as' => 'bid.Userlist', 'uses' => 'ArtisansController@bidProjectUserlist']);
            Route::get('/edit-job/{id}/{slug}', ['as' => 'edit.job', 'uses' => 'ArtisansController@editJob']);
            Route::post('/update-job', ['as' => 'update-job-post', 'uses' => 'ArtisansController@updateJob']);
            Route::post('/delete-job', ['as' => 'job.delete', 'uses' => 'ArtisansController@deleteJob']);
            Route::get('/awarded-list', ['as' => 'assign.list', 'uses' => 'ArtisansController@assignList']);
            Route::post('/approve-job-payment', ['as' => 'approve.job.payment', 'uses' => 'ArtisansController@ApproveJobPayment']);
            Route::get('/awarded-list', ['as' => 'assign.list', 'uses' => 'ArtisansController@assignList']);
            Route::get('/withdraw-log', 'ArtisansController@withdrawLog')->name('artisan.withdrawLog');
            Route::get('/payment-history', 'ArtisansController@PaymentHistory')->name('artisan.payment-history');
            Route::post('/withdraw-submit', 'ArtisansController@requestSubmit')->name('wallet.withdrawal');
            Route::get('/kyc-upload', ['as' => 'kyc.upload', 'uses' => 'ArtisansController@kycUpload']);
            Route::post('/add-kyc-upload', ['as' => 'add.kycupload', 'uses' => 'ArtisansController@kycUploadProcess']);
            Route::post('/edit-kyc-upload', ['as' => 'edit.kycupload', 'uses' => 'ArtisansController@assignList']);
        });
            Route::get('/job-details/{id}/{slug}', ['as' => 'details.job', 'uses' => 'ArtisansController@detailsJob']);
            Route::get('/biography/{id}/{slug}', ['as' => 'biography', 'uses' => 'ArtisansController@biography']);
            Route::post('/mail-author', ['as' => 'mail.author', 'uses' => 'ArtisansController@mailAuthor']);
            Route::post('/bit-project-job', ['as' => 'bit.job', 'uses' => 'ArtisansController@bitJob']);
            Route::post('/bit-job-home', ['as' => 'bit.job.home', 'uses' => 'ArtisansController@bitJobHomePage']);
            Route::get('/job-details/{id}/{slug}', ['as' => 'details.job', 'uses' => 'ArtisansController@detailsJob']);
            Route::post('/assign-job', ['as' => 'assign.job', 'uses' => 'ArtisansController@assignJob']);
            Route::post('/assign-job-profile', ['as' => 'assign.job.profile', 'uses' => 'ArtisansController@Assignbiography']);
            Route::get('/all-artisans', 'ArtisansController@AllArtisans')->name('artisan.all-artisans');
            Route::get('/acquired-list', ['as' => 'acquired.list', 'uses' => 'ArtisansController@acquiredList']);
            Route::get('/biography/{id}/{slug}', ['as' => 'biography', 'uses' => 'ArtisansController@biography']);
            Route::post('remove-assign-list', ['as' => 'remove.assign.list', 'uses' => 'ArtisansController@removeAssignList']);
            Route::post('reject-assign-list', ['as' => 'reject.assign.list', 'uses' => 'ArtisansController@rejectAssignList']);
            Route::get('/chat/{id}', 'ArtisansController@index')->name('chat.user');
            Route::post('/get-chat', 'ArtisansController@getChat')->name('get.chat');
            Route::post('/messages', 'ArtisansController@sendMessage')->name('store.message');
            Route::get('/messages', ['as' => 'user.messages', 'uses' => 'ArtisansController@messageslist']);
    });
    
    
    // Real Estate
    Route::prefix('estate/agent')->group(function(){
        Route::middleware(['subscribed','profile.complete'])->group(function(){
            Route::get('/home', 'RealEstateController@dashboard')->name('estate.dashboard');
            Route::get('/create', 'RealEstateController@createProperty')->name('estate.create.property');
            Route::post('/post/create', 'RealEstateController@createPropertyProcess')->name('estate.create.property.process');
            Route::get('/edit/property/{id}', 'RealEstateController@editProperty')->name('estate.edit.property');
            Route::post('/edit/property/post', 'RealEstateController@createPropertyProcess')->name('estate.edit.property.process');
            Route::get('/delete/property/{id}', 'RealEstateController@propertyDeleteProcess')->name('estate.delete.property');
            Route::get('/customer/requests', 'RealEstateController@propertyCustomerRequest')->name('estate.customer.request');
            Route::get('/delete/request/{slug}', 'RealEstateController@deletePropertyCustomerRequest')->name('estate.delete.customer.request');
        });
        
        Route::get('/property/payments', 'RealEstateController@propertyPayments')->name('estate.property.payments');
        Route::get('/featured/properties', 'RealEstateController@featuredProperty')->name('estate.featured.property');
        Route::get('/all/properties', 'RealEstateController@allProperty')->name('estate.all.property');
    });
    
    
    // Eforms
    Route::prefix('eforms/registrar')->group(function(){
        Route::middleware(['subscribed','profile.complete'])->group(function(){
            Route::get('/home', 'InstituteFormsController@dashboard')->name('registrar.dashboard');
        });
        Route::get('/create/institute', 'InstituteFormsController@registrarCreate')->name('registrar.create.institute');
        Route::post('/create/post/institute', 'InstituteFormsController@registrarCreateProcess')->name('registrar.create.post.institute');
        
        Route::get('/edit/institute/{slug}', 'InstituteFormsController@registrarEdit')->name('registrar.edit.institute');
        Route::get('/show/institutes', 'InstituteFormsController@showInstitute')->name('registrar.show.institute');
        Route::post('/edit/institute/{slug}', 'InstituteFormsController@registrarEditProcess')->name('registrar.edit.institute');
        Route::post('/delete/institute', 'InstituteFormsController@registrarDeleteProcess')->name('registrar.delete.institute');
        
        Route::get('/create/institute/eforms', 'InstituteFormsController@createEform')->name('registrar.create.eforms');
        Route::post('/create/institute/eforms', 'InstituteFormsController@createEformProcess')->name('registrar.create.eforms');
        Route::get('/final/institute/eforms/{reference}', 'InstituteFormsController@finalEform')->name('registrar.final.eforms');
        Route::post('/final/institute/eforms/{reference}', 'InstituteFormsController@finalEformProcess')->name('registrar.final.eforms');
        Route::get('/show/institute/eforms', 'InstituteFormsController@showEform')->name('registrar.show.eforms');
        Route::get('/present/institute/eforms/{reference}', 'InstituteFormsController@presentEform')->name('registrar.present.eforms');
        Route::get('/edit/institute/eforms/{reference}', 'InstituteFormsController@editEform')->name('registrar.edit.eforms');
        Route::post('/edit/institute/post/eforms', 'InstituteFormsController@editEformProcess')->name('registrar.edit.process.eforms');
        Route::post('/delete/institute/eforms', 'InstituteFormsController@deleteEformProcess')->name('registrar.delete.eforms');
        
        Route::any('/apply/institute/eforms/all', 'InstituteFormsController@allApplyEform')->name('all.apply.eforms');
        Route::get('/apply/institute/eforms/{reference}', 'InstituteFormsController@applyEform')->name('apply.eforms');
        Route::post('/apply/institute/eforms/{reference}', 'InstituteFormsController@applyEformProcess')->name('apply.eforms');
        Route::get('/preview/apply/institute/eforms/{reference}', 'InstituteFormsController@previewApplyEform')->name('preview.apply.eforms');
        Route::get('/delete/apply/institute/eforms/{reference}', 'InstituteFormsController@deleteApplyEformProcess')->name('delete.apply.eforms');
        
    });
    
    
    // booking
    Route::prefix('booking/agent')->group(function(){
        Route::middleware(['subscribed','profile.complete'])->group(function(){
            Route::get('/home', 'BookingsController@dashboard')->name('booking.dashboard');
            /* Payment */
            Route::get('payment-log/{id?}', 'BookingsController@paymentLog')->name('booking.payment-history');
            Route::get('/withdraw-log', 'ArtisansController@withdrawLog')->name('booking.withdrawLog');
            Route::post('/withdraw-submit', 'ArtisansController@requestSubmit')->name('wallet.withdrawal');
        });
        ///////////////////////////////// guests///////////////////////
        Route::get('guests', 'BookingsController@guest')->name('guests');
        Route::get('guests/create', 'BookingsController@create_guest')->name('guests.create');
        Route::post('guests/store', 'BookingsController@store_guest')->name('guests.store');
        Route::get('guests/{id}/view', 'BookingsController@view_guest')->name('guests.view');
        Route::post('guests/{id}/update', 'BookingsController@update_guest')->name('guests.update');
        
        ///////////////////////////////// Reservation///////////////////////
        Route::get('/reservations/{booking_type?}', 'BookingsController@reservations')->name('reservations');
        Route::get('reservation/create', 'BookingsController@create_reservation')->name('reservation.create');
        Route::post('reservation/store', 'BookingsController@store_reservation')->name('reservation.store');
        Route::get('reservation/{id}/view', 'BookingsController@view_reservation')->name('reservation.view');
        Route::get('reservation/{id}/confirm', 'BookingsController@confirm_reservation')->name('reservation.confirm');
        Route::post('reservation/{id}/confirm-post', 'BookingsController@confirmPost_reservation')->name('reservation.confirm_post');
        Route::get('reservation/{id}/change-status/{status}', 'BookingsController@changeStatus_reservation')->name('reservation.change_status');
        Route::post('reservation/{id}/payment', 'BookingsController@payment_reservation')->name('reservation.payment');
        Route::post('reservation/{id}/add_service', 'BookingsController@addService_reservation')->name('reservation.add_service');
        Route::post('reservation/{id}/remove_service', 'BookingsController@removeService_reservation')->name('reservation.remove_service');
        Route::post('reservation/{id}/cancel_room', 'BookingsController@cancelRoom_reservation')->name('reservation.cancel_room');
        Route::post('reservation/{id}/change_room', 'BookingsController@changeRoom_reservation')->name('reservation.change_room');

        Route::get('reservation/get-room-type-details','BookingsController@getRoomTypeDetails_reservation')->name('reservation.get_room_type_details');
        Route::get('reservation/get-night-calculation','BookingsController@getNightCalculation_reservation')->name('reservation.get_night_calculation');
        Route::get('reservation/get-checkout-available-date','BookingsController@getCheckOutAvailableDate_reservation')->name('reservation.get_checkout_available_date');
        Route::get('reservation/apply-coupon','BookingsController@applyCoupon_reservation')->name('reservation.apply_coupon');
        
        ///////////////////////////////// Room///////////////////////
        Route::get('room', 'BookingsController@room')->name('room');
        Route::get('room/create', 'BookingsController@create_room')->name('room.create');
        Route::post('room/store', 'BookingsController@store_room')->name('room.store');
        Route::get('room/{id}/edit', 'BookingsController@edit_room')->name('room.edit');
        Route::post('room/{id}/update', 'BookingsController@update_room')->name('room.update');
        Route::post('room/{id}/delete', 'BookingsController@delete_room')->name('room.delete');
        /**                Room type***/
        Route::get('room-type', 'BookingsController@roomtype')->name('room_type');
        Route::get('room-type/create', 'BookingsController@create_roomtype')->name('room_type.create');
        Route::post('room-type/store', 'BookingsController@store_roomtype')->name('room_type.store');
        Route::get('room-type/{id}/view', 'BookingsController@view_roomtype')->name('room_type.view');
        Route::get('room-type/{id}/edit', 'BookingsController@edit_roomtype')->name('room_type.edit');
        Route::post('room-type/{id}/update', 'BookingsController@update_roomtype')->name('room_type.update');
        /**                Room type   image* **/
        Route::post('room-type/upload-image', 'BookingsController@uploadImage_roomtype')->name('room_type_upload_image');
        Route::post('room-type/delete-image', 'BookingsController@deleteImage_roomtype')->name('room_type_delete_image');
        Route::get('room-type/{room_type_id}/{id}/set-as-featured', 'BookingsController@setAsFeatured_roomtype')->name('room_type_set_as_featured');
        /**                Room type   update regular price* **/

        Route::post('room-type/regular-price/{id}/update', 'BookingsController@regularPriceUpdate')->name('regular_price_update');
        Route::post('room-type/special-price/{id}/update', 'BookingsController@specialPriceUpdate')->name('special_price_update');
        
        ///             Amenities
        Route::get('amenities', 'BookingsController@amenities')->name('amenities');
        Route::get('amenities/create', 'BookingsController@create_amenities')->name('amenities.create');
        Route::post('amenities/store', 'BookingsController@store_amenities')->name('amenities.store');
        Route::get('amenities/{id}/edit', 'BookingsController@edit_amenities')->name('amenities.edit');
        Route::post('amenities/{id}/update', 'BookingsController@update_amenities')->name('amenities.update');
        Route::post('amenities/{id}/delete', 'BookingsController@delete_amenities')->name('amenities.delete');
        
        ///             Floor
        Route::get('floor', 'BookingsController@floor')->name('floor');
        Route::get('floor/create', 'BookingsController@create_floor')->name('floor.create');
        Route::post('floor/store', 'BookingsController@store_floor')->name('floor.store');
        Route::get('floor/{id}/edit', 'BookingsController@edit_floor')->name('floor.edit');
        Route::post('floor/{id}/update', 'BookingsController@update_floor')->name('floor.update');
        Route::post('floor/{id}/delete', 'BookingsController@delete_floor')->name('floor.delete');
        
        ///             Tax
        Route::get('tax', 'BookingsController@tax')->name('tax');
        Route::get('tax/create', 'BookingsController@create_tax')->name('tax.create');
        Route::post('tax/store', 'BookingsController@store_tax')->name('tax.store');
        Route::get('tax/{id}/edit', 'BookingsController@edit_tax')->name('tax.edit');
        Route::post('tax/{id}/update', 'BookingsController@update_tax')->name('tax.update');
        Route::post('tax/{id}/delete', 'BookingsController@delete_tax')->name('tax.delete');
        
        ///             Paid service
        Route::get('paid-service', 'BookingsController@paid_service')->name('paid_service');
        Route::get('paid-service/create', 'BookingsController@create_paid_service')->name('paid_service.create');
        Route::post('paid-service/store', 'BookingsController@store_paid_service')->name('paid_service.store');
        Route::get('paid-service/{id}/edit', 'BookingsController@edit_paid_service')->name('paid_service.edit');
        Route::post('paid-service/{id}/update', 'BookingsController@update_paid_service')->name('paid_service.update');
        Route::post('paid-service/{id}/delete', 'BookingsController@delete_paid_service')->name('paid_service.delete');

        ///             Coupon Master
        Route::get('coupon', 'BookingsController@coupon')->name('coupon');
        Route::get('coupon/create', 'BookingsController@create_coupon')->name('coupon.create');
        Route::post('coupon/store', 'BookingsController@store_coupon')->name('coupon.store');
        Route::get('coupon/{id}/edit', 'BookingsController@edit_coupon')->name('coupon.edit');
        Route::post('coupon/{id}/update', 'BookingsController@update_coupon')->name('coupon.update');
        Route::post('coupon/{id}/delete', 'BookingsController@delete_coupon')->name('coupon.delete');
        
        // Flight Booking
        Route::get('create-flight-partner', 'BookingsController@create_flight_partner')->name('flight.create-flight-partner');
        Route::post('create-flight-partner', 'BookingsController@create_flight_post')->name('flight.create-flight-post');
        Route::get('create-flight-available', 'BookingsController@create_flight_available')->name('flight.create-flight-available');
        Route::post('create-flight-available', 'BookingsController@available_flight_post')->name('flight.create-available-post');
        Route::get('flight-available', 'BookingsController@flight_available')->name('flight.flight-available');
        Route::get('flight-available/{id}/edit', 'BookingsController@flight_edit_available')->name('flight.flight-available-edit');
        Route::post('flight-available/{id}/edit', 'BookingsController@flight_edit_available_post')->name('flight.flight-available-edit');
        Route::get('flight-available/{id}/delete', 'BookingsController@flight_delete_available')->name('flight.flight-available-delete');
        Route::get('flight-booked', 'BookingsController@flight_booked')->name('flight.flight-booked');
        Route::get('flight-booked/{id}/view', 'BookingsController@flight_view_booked')->name('flight.flight-booked-view');
        
    });

});

Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
Route::any('/orders/details', 'OrderController@order_details')->name('orders.details');
Route::post('/orders/update_delivery_status', 'OrderController@update_delivery_status')->name('orders.update_delivery_status');
Route::post('/orders/update_payment_status', 'OrderController@update_payment_status')->name('orders.update_payment_status');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/checkout/save', 'OrderController@store')->name('order.save');
Route::any('/checkout/order/pay', 'OrderController@payment')->name('order.pay');
Route::get('/checkout/order/success', 'OrderController@success')->name('order.success');
Route::get('/brands', 'PagesController@all_brands')->name('brands.all');
Route::get('/categories', 'PagesController@all_categories')->name('categories.all');
Route::get('/category/{slug}', 'PagesController@product_listing_category')->name('products.by_category');
Route::get('/search?q={search}', 'PagesController@search')->name('suggestion.search');

// Route::group(['middleware' => ['user', 'verified']], function(){
	// Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
	Route::get('/profile', 'PagesController@profile')->name('profile');
	Route::post('/customer/update-profile', 'PagesController@customer_update_profile')->name('customer.profile.update');

// });


// admin routes
Route::middleware('admin')->group(function () {

Route::prefix('eb-admin')->group(function()
{


    Route::middleware('access:manager,900')->group(function () {
        Route::post('staff/permissions/update/{id}', 'PermissionController@update');
        Route::get('staff/permissions/edit/{id}', 'PermissionController@edit');
        Route::post('staff/permissions/post-permission', 'PermissionController@postPermission');
        Route::resource('staff/permissions', 'PermissionController');

        Route::post('staff/roles/update/{id}', 'RoleController@update');
        Route::get('staff/roles/edit/{id}', 'RoleController@edit');
        Route::post('staff/roles/save', 'RoleController@store');
        Route::resource('staff/roles', 'RoleController');
        
        Route::post('staff/update/{id}', 'StaffController@update');
        Route::get('staff/add', 'StaffController@add');
        Route::get('staff/edit/{id}', 'StaffController@edit');
        Route::post('staff/register-staff', 'StaffController@store');
        Route::resource('staff', 'StaffController');
    });


    Route::middleware('access:manager,200')->group(function () {   
        Route::get('categories/delete/{id}', 'CategoryController@destroy')->name('category.delete');
        Route::post('categories/update/{id}', 'CategoryController@update')->name('category.update');
        Route::any('categories/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::post('categories/add', 'CategoryController@store')->name('category.add');
        Route::get('categories/create', 'CategoryController@create')->name('category.create');
        Route::get('categories', 'CategoryController@index')->name('category.index');


        Route::get('subcategories/delete/{id}', 'SubCategoryController@destroy')->name('subcategory.delete');
        Route::post('subcategories/update/{id}', 'SubCategoryController@update')->name('subcategory.update');
        Route::any('subcategories/edit/{id}', 'SubCategoryController@edit')->name('subcategory.edit');
        Route::post('subcategories/add', 'SubCategoryController@store')->name('subcategory.add');
        Route::get('subcategories/create', 'SubCategoryController@create')->name('subcategory.create');
        Route::get('subcategories', 'SubCategoryController@index')->name('subcategory.index');

        
        Route::get('subsubcategories/delete/{id}', 'SubSubCategoryController@destroy')->name('subsubcategory.delete');
        Route::post('subsubcategories/update/{id}', 'SubSubCategoryController@update')->name('subsubcategory.update');
        Route::any('subsubcategories/edit/{id}', 'SubSubCategoryController@edit')->name('subsubcategory.edit');
        Route::post('subsubcategories/add', 'SubSubCategoryController@store')->name('subsubcategory.add');
        Route::get('subsubcategories/create', 'SubSubCategoryController@create')->name('subsubcategory.create');
        Route::get('subsubcategories', 'SubSubCategoryController@index')->name('subsubcategory.index');
        
        Route::get('market/delete/{id}', 'AdminController@destroyMarket')->name('market.delete');
        Route::post('maarket/update/{id}', 'AdminController@updateMarket')->name('market.update');
        Route::any('market/edit/{id}', 'AdminController@editMarket')->name('market.edit');
        Route::post('market/store', 'AdminController@storeMarket')->name('market.store');
        Route::get('market/create', 'AdminController@createMarket')->name('market.create');
        Route::get('markets', 'AdminController@market')->name('market.index');

        Route::get('brands/delete/{id}', 'BrandController@destroy')->name('brand.delete');
        Route::post('brands/update/{id}', 'BrandController@update')->name('brand.update');
        Route::any('brands/edit/{id}', 'BrandController@edit')->name('brand.edit');
        Route::post('brands/add', 'BrandController@store')->name('brand.add');
        Route::get('brands/create', 'BrandController@create')->name('brand.create');
        Route::get('brands', 'BrandController@index')->name('brand.index');

        Route::get('products/delete/{id}', 'ProductController@destroy')->name('product.delete');
        Route::any('products/sku_combination', 'ProductController@sku_combination')->name('products.sku_combination');
        Route::post('products/update/{id}', 'ProductController@update')->name('product.update');
        Route::any('products/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::any('products/view/{id}', 'PagesController@admin_product_view')->name('product.view');
        Route::post('products/add', 'ProductController@store')->name('product.add');
        Route::post('products/create', 'ProductController@create')->name('product.create');
    	Route::post('/products/featured', 'ProductController@updateFeatured')->name('products.featured');
    	Route::post('/products/todays_deal','ProductController@updateTodaysDeal')->name('products.todays_deal');
    	Route::post('/products/published', 'ProductController@updatePublished')->name('products.published');
        Route::resource('products', 'ProductController');
        
        Route::get('market/delete/{id}', 'AdminController@destroyMarket')->name('market.delete');
        Route::post('maarket/update/{id}', 'AdminController@updateMarket')->name('market.update');
        Route::any('market/edit/{id}', 'AdminController@editMarket')->name('market.edit');
        Route::post('market/store', 'AdminController@storeMarket')->name('market.store');
        Route::get('market/create', 'AdminController@createMarket')->name('market.create');
        Route::get('markets', 'AdminController@market')->name('market.index');
        
        Route::get('shipping-rates/delete/{id}', 'ShippingController@destroy')->name('shipping.delete');
        Route::post('shipping-rates/update/{id}', 'ShippingController@update')->name('shipping.update');
        Route::any('shipping-rates/edit/{id}', 'ShippingController@edit')->name('shipping.edit');
        Route::post('shipping-rates/add', 'ShippingController@store')->name('shipping.add');
        Route::get('shipping-rates/create', 'ShippingController@create')->name('shipping.create');
        Route::get('shipping-rates', 'ShippingController@index')->name('shipping.index');
        
        /* Real Estate */
        // estate category
        Route::get('/estate-category', 'AdminController@estateCategoryIndex');
        Route::get('estate-category/add', 'AdminController@estateCategoryAdd');
        Route::post('estate-category/register-estate-category', 'AdminController@estateCategoryStore');
        Route::get('estate-category/edit/{id}', 'AdminController@estateCategoryEdit');
        Route::post('estate-category/update/{id}', 'AdminController@estateCategoryUpdate');
		Route::get('/estate-category/delete', 'AdminController@estateCategoryDelete');
		
		// estate features
        Route::get('/estate-features', 'AdminController@estateFeatureIndex');
        Route::get('estate-features/add', 'AdminController@estateFeatureAdd');
        Route::post('estate-features/register-estate-features', 'AdminController@estateFeatureStore');
        Route::get('estate-features/edit/{id}', 'AdminController@estateFeatureEdit');
        Route::post('estate-features/update/{id}', 'AdminController@estateFeatureUpdate');
		Route::get('/estate-features/delete', 'AdminController@estateFeatureDelete');
		
		// estate rooms
        Route::get('/estate-types', 'AdminController@estateTypeIndex');
        Route::get('estate-types/add', 'AdminController@estateTypeAdd');
        Route::post('estate-types/register-estate-types', 'AdminController@estateTypeStore');
        Route::get('estate-types/edit/{id}', 'AdminController@estateTypeEdit');
        Route::post('estate-types/update/{id}', 'AdminController@estateTypeUpdate');
		Route::get('/estate-types/delete', 'AdminController@estateTypeDelete');
		
		// estate requests
        Route::get('/estate-requests', 'AdminController@estateRequestIndex');
		
    });

    Route::middleware('access:manager,901')->group(function () {
        Route::post('seller/update/info/{id}', 'SellerController@updateInfo')->name('seller.update.info');
        Route::post('seller/update/bank/{id}', 'SellerController@updateBank')->name('seller.update.bank');
        Route::any('seller/edit/{id}', 'SellerController@edit')->name('seller.edit');
        Route::post('seller/add', 'SellerController@store')->name('seller.add');
        Route::resource('sellers', 'SellerController');
    });
        Route::get('orders', 'OrderController@index')->name('orders.list');
        Route::post('orders/cancel', 'OrderController@adminCancelOrder')->name('orders.cancel');
        Route::get('orders/approve', 'OrderController@adminApproveOrder')->name('orders.approve');
        
        Route::get('/subscriptions', 'SubscriptionController@index')->name('subscribers');
        Route::get('/subscribe', 'SubscriptionController@subscribeVendor')->name('sub.subscribe');
        Route::post('/subscription/store', 'SubscriptionController@storeSubscription')->name('sub.store');
        Route::post('/subscription/upgrade', 'SubscriptionController@upgradeSubscription')->name('sub.upgrade');
        Route::get('/subscription/renew/{id}', 'SubscriptionController@renewSubscription')->name('sub.renew');
        Route::get('/subscription/activate/{id}', 'SubscriptionController@activateSubscription')->name('sub.activate');
        Route::get('/subscription/delete/{id}', 'SubscriptionController@deleteSubscription')->name('sub.delete');
        Route::get('/subscription/cancel/{id}', 'SubscriptionController@cancelSubscription')->name('sub.cancel');
        
        Route::get('/subscription/plans', 'SubscriptionController@subscriptionPlan')->name('sub.plans');
        Route::get('/subscription/plan/create', 'SubscriptionController@subscriptionCreatePlan')->name('sub.create_plan');
        Route::get('/subscription/plan/edit/{id}', 'SubscriptionController@subscriptionEditPlan')->name('sub.edit_plan');
        Route::get('/subscription/plan/delete/{id}', 'SubscriptionController@subscriptionDeletePlan')->name('sub.delete_plan');
        Route::post('/subscription/plan/store', 'SubscriptionController@subscriptionStorePlan')->name('sub.store_plan');
        Route::post('/subscription/plan/update/{id}', 'SubscriptionController@subscriptionUpdatePlan')->name('sub.update_plan');
        
        Route::post('users/update/{id}', 'UsersController@admin_update_user')->name('users.update');
        Route::get('users/create', 'UsersController@admin_create_user')->name('users.create');
        Route::post('users/add', 'UsersController@admin_store_user')->name('users.add');
        Route::get('users/edit/{id}', 'UsersController@admin_edit_user')->name('users.edit');
        Route::get('users', 'UsersController@admin_view_user')->name('users.list');
        
        Route::get('/pages', 'AdminController@pages')->name('page.index');
        Route::get('/page/create', 'AdminController@createPage')->name('page.create');
        Route::get('/page/edit/{id}', 'AdminController@editPage')->name('page.edit');
        Route::post('/page/store', 'AdminController@storePage')->name('page.store');
        Route::post('/page/update/{id}', 'AdminController@updatePage')->name('page.update');
        Route::get('/page/delete/{id}', 'AdminController@deletePage')->name('page.delete');
        
        Route::get('/payments', 'AdminController@payments')->name('payment.index');
        Route::get('/payment/approve', 'AdminController@approvePayment')->name('payment.approve');
        
        Route::get('/', 'AdminController@index');
        Route::get('{page}', 'AdminController@admin');

                    //    Admin artisan control
                    /*Route::post('artisan/add', 'ArtisanController@add_artisan')->name('artisan.add');
                    Route::get('artisan/edit/{id}', 'ArtisanController@edit_artisan')->name('artisan.edit');
                    Route::post('artisan/update/{id}', 'ArtisanController@update_artisan')->name('artisan.update');
                    Route::get('artisan', 'ArtisanController@list_artisan')->name('artisan.view');
                    Route::post('artisan/store', 'ArtisanController@store_artisan')->name('artisan.store');
                    Route::get('artisan/show', 'ArtisanController@show_artisan')->name('artisan.show');
            
                    Route::get('artisan/jobs', 'ArtisanController@jobs')->name('artisan.job');
            
                    Route::get('artisan/services', 'ArtisanController@artisan_services')->name('artisan.service');
            
                    Route::get('artisan/type', 'ArtisanController@artisan_type')->name('artisan.type');
                    Route:: get('artisan/type/add', 'ArtisanController@add_artisan_type')->name('artisan_type.add');
                    Route::get('artisan/type/edit/{id}', 'ArtisanController@edit_artisan_type')->name('artisan_type.edit');
                    Route::post('artisan/type/update/{id}', 'ArtisanController@update_artisan_type')->name('artisan_type.update');
                    Route::post('artisan/type/store', 'ArtisanController@store_artisan_type')->name('artisan_type.store');*/
            
                    Route::get(' subscription_plan', 'SubscriptionController@plan')->name('subscription_plan.view');
                    Route::post('subscription_plan/add', 'SubscriptionController@add_plan')->name('subscription_plan.add');
                    Route::post('subscription_plan/edit/{id}', 'SubscriptionController@edit_plan')->name('subscription_plan.edit');
            
                    Route::get('vendor_subscription', 'SubscriptionController@vendor_subscription')->name('vendor_subscription.view');
                    Route::get('vendor_subscription/cancel/{id}', 'SubscriptionController@cancel_vendor_subscription')->name('vendor_subscription.cancel');
                    Route::post('vendor_subscription/approve/{id}', 'SubscriptionController@approve_vendor_subscription')->name('vendor_subscription.approve');
            
                    Route::get('vendor_verification', 'SubscriptionController@vendor_verification')->name('vendor_verification.view');
                    Route::post('vendor_verification/approve/{id}', 'SubscriptionController@approve_vendor_verification')->name('vendor_verification.approve');
                    Route::post('vendor_verification/decline/{id}', 'SubscriptionController@decline_vendor_verification')->name('vendor_verification.decline');
            
                    Route::get('kyc_verification', 'SubscriptionController@kyc_verification')->name('kyc_verification.view');
                    Route::get('kyc_upload', 'SubscriptionController@kyc_upload')->name('kyc_upload.view');
                    Route::post('kyc_verification/approve/{id}', 'SubscriptionController@approve_kyc_verification')->name('kyc_verification.approve');
                    Route::post('kyc_verification/decline/{id}', 'SubscriptionController@decline_kyc_verification')->name('kyc_verification.decline');
            
                    Route::get('withdrawal_request', 'WithdrawalController@vendor_verification')->name('withdrawal_request.view');
                    Route::post('withdrawal_requst/approve/{id}', 'WithdrawalController@approve_withdrawal_request')->name('withdrawal_request.approve');
                    Route::post('vendor_verification/decline/{id}', 'WithdrawalController@decline_withdrawal_request')->name('withdrawal_request.decline');
                    
                    Route::get('withdrawals', 'WithdrawalController@withdrawals')->name('withdrawals.view');
                            // End of admin artisan control
                        

    
});
    
});




Route::prefix('sellers')->group(function(){
     Route::middleware(['subscribed','seller','profile.complete'])->group(function(){   
        Route::get('dashboard', 'SellerController@seller_dashboard')->name('seller.index');
        
        Route::get('earning', 'SellerController@sellerEarning')->name('seller.earning');
        Route::get('track', 'SellerController@track')->name('seller.track');
        Route::get('stores', 'SellerController@Stores')->name('seller.store');
        Route::get('stores/add', 'SellerController@createStore')->name('seller.create-store');
        Route::post('store/save', 'SellerController@addStore')->name('seller.save-store');
        Route::get('store/edit/{id}', 'SellerController@editStore')->name('seller.edit-store');
        Route::post('store/update', 'SellerController@updateStore')->name('seller.update-store');
        Route::get('store/delete/{id}', 'SellerController@deleteStore')->name('seller.delete-store');
        Route::post('track-order', 'SellerController@trackPost')->name('seller.track-order');
        Route::post('earning/withdraw', 'SellerController@withdrawEarning')->name('seller.withdraw_earning');
        Route::get('withdraw/request', 'SellerController@withdraw_request')->name('seller.withdraw_request');

        Route::get('products', 'ProductController@seller_product')->name('seller.product');
        Route::post('products/store', 'ProductController@store')->name('seller.add_product');
        Route::post('products/sku_combination', 'ProductController@sku_combination')->name('seller.sku_combination');
        Route::post('products/sku_combination_edit', 'ProductController@sku_combination_edit')->name('seller.sku_combination_edit');
        Route::post('products/update', 'ProductController@update')->name('seller.update_product');
        Route::get('products/add/{step}', 'ProductController@seller_product_add')->name('seller.product_add');
        Route::any('products/add/{step}/{action}', 'ProductController@seller_product_action')->name('seller.product_action');
        Route::get('products/edit/{id}', 'ProductController@seller_product_edit')->name('seller.product_edit');
        Route::get('products/preview/{id}', 'PagesController@seller_product_view')->name('seller.product_view');
        Route::get('products/delete/{id}', 'ProductController@destroy')->name('seller.product_delete');
        Route::get('products/review', 'ProductController@product_review')->name('seller.product_review');

        Route::get('sales', 'OrderController@seller')->name('seller.sales');
     });
});
Route::prefix('vendors')->group(function(){
    Route::post('store', 'VendorController@quickRegistrationStore')->name('vendor.register_store');
    Route::get('registration', 'VendorController@Registration')->name('vendor.register');
    Route::get('quick/registration', 'VendorController@quickRegistration')->name('vendor.quick_register');
    Route::post('load_input', 'VendorController@loadInput')->name('vendor.load_input');
    Route::get('payment', 'VendorController@vendor_payment')->name('vendor.payment');
    Route::post('load_plan', 'VendorController@loadPlan')->name('vendor.load_plan');
});
Route::get('subscription/payment', 'VendorController@vendor_payment')->name('vendor.login_payment');
Route::post('subcategories/get_sub_categories', 'SubCategoryController@get_subcategories_by_category')->name('subcategories.get');
Route::post('subsubcategories/get_sub_subcategories', 'SubSubCategoryController@get_subsubcategories_by_subcategory')->name('subsubcategories.get');

Route::post('state/markets/get', 'PagesController@get_markets_by_state')->name('markets.get');

Route::post('post-login', 'AuthController@postLogin'); 
Route::post('post-register', 'AuthController@postRegister'); 
Route::get('dashboard', 'AuthController@dashboard')->name('dashboard'); 
Route::get('logout', 'AuthController@logout')->name('logout');


//pages route
Route::get('/all_products', 'PagesController@product_listing')->name('products');

Route::any('/{slug}', 'PagesController@single_product')->name('product');
Route::get('/category', 'PagesController@product_search')->name('products.category');

Route::get('/search?subcategory={subcategory_slug}', 'PagesController@search')->name('products.subcategory');
Route::get('/search?subsubcategory={subsubcategory_slug}', 'PagesController@search')->name('products.subsubcategory');
Route::get('/search?brand={brand_slug}', 'PagesController@search')->name('products.brand');
Route::post('/product/variant_price', 'PagesController@variant_price')->name('products.variant_price');
Route::get('/stores/visit/{slug}', 'PagesController@shop')->name('store.visit');
Route::get('/stores/visit/{slug}/{type}', 'PagesController@filter_shop')->name('store.visit.type');




    Route::post('reviews/store', 'ReviewController@store')->name('reviews.store');
    // Route::resource('/reviews', 'ReviewController');

    // Route::resource('orders','OrderController');


	Route::resource('/withdraw_requests', 'SellerWithdrawRequestController');
	Route::get('/withdraw_requests_all', 'SellerWithdrawRequestController@request_index')->name('withdraw_requests_all');
	Route::post('/withdraw_request/payment_modal', 'SellerWithdrawRequestController@payment_modal')->name('withdraw_request.payment_modal');
    Route::post('/withdraw_request/message_modal', 'SellerWithdrawRequestController@message_modal')->name('withdraw_request.message_modal');
 






//category dropdown menu ajax call
Route::post('/category/nav-element-list', 'PagesController@get_category_items')->name('category.elements');

//Flash Deal Details Page
Route::get('/flash-deal/{slug}', 'PagesController@flash_deal_details')->name('flash-deal-details');


// Route::get('/terms', 'PagesController@page');
// Route::get('/help', 'PagesController@page');
// Route::get('/faq', 'PagesController@page');
// Route::get('/privacy', 'PagesController@page');
// Route::get('/contact', 'PagesController@page');
// Route::get('/product_listing', 'PagesController@page');

Route::domain('marketplace.ebeanomarket.com')->group(function () {
    Route::get('/', 'MarketPlaceController@index');
});

Route::redirect('/realestate', '');
Route::redirect('/https://realestate.ebeanomarket.com', '/real-estate');


