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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.login');
});

Route::get('/forgotpassword', function () {
    return view('admin.forgotpassword');
});

Route::post('admin/login/validate', 'Admin\LoginController@index');

//Route::post('admin/forgotpassword/checkemail', 'Admin\ForgotPasswordController@verifyEmail');



// Route for email marketing
//Route::get('admin/box-office/email-marketing/overView','Admin\EmailMarketingController@index');
Route::group(['prefix'=>'admin/box-office/email-marketing'],function(){
    Route::get('/overView','Admin\EmailMarketingController@index');
    
    Route::get('/sendmail', 'Admin\EmailMarketingController@sendMail');
    Route::get('/campaign','Admin\EmailMarketingController@campaignCreate');

    // Route for Email-marketing Contact
    Route::resource('emailcontact','Admin\emailCampaign\ContactController');

    // Route for Email-marketing Contact group
    Route::resource('emailgroup', 'Admin\emailCampaign\GroupController');
    Route::post('emailgroup/mass-delete', 'Admin\emailCampaign\GroupController@postMassDelete'); 
});
// Route for email marketing


Route::group(['prefix'=>'forgot-password'],function(){

    Route::post('/checkemail', 'Admin\ForgotPasswordController@verifyEmail');
    Route::post('/getLink','Admin\ForgotPasswordController@resetPassword');
    Route::get('/password-reset','Admin\ForgotPasswordController@verifyURL');
    Route::post('/new-password','Admin\ForgotPasswordController@getNewPassword');
});

Route::group(['prefix'=>'admin','middleware'=> 'admin'], function(){

	Route::get('dashboard', 'Admin\DashboardController@index');
	Route::get('logout', 'Admin\LoginController@logout');


    // Route for Sms Campaign
    Route::group(['prefix'=>'box-office/smsCampaigns'], function(){
        Route::get('/overView', 'Admin\smsCampaign\OverViewController@index');

        //Route for Contact
        Route::post('contact/mass-delete', 'Admin\smsCampaign\ContactController@postMassDelete');
        Route::resource('contact', 'Admin\smsCampaign\ContactController');
        Route::post('contact/import/{xlsx}', 'Admin\smsCampaign\ContactController@import');
        Route::post('contact/associated-group/delete', 'Admin\smsCampaign\ContactController@deleteContactFromGroup');
        Route::post('contact/associated-group/add', 'Admin\smsCampaign\ContactController@addContactToGroup');
        //Route for contact ends

        // Route for Contact Group

        Route::post('group/mass-delete', 'Admin\smsCampaign\GroupController@postMassDelete');
        Route::resource('group', 'Admin\smsCampaign\GroupController');
        Route::post('group/add-contacts', 'Admin\smsCampaign\GroupController@postAddContactsToGroup');
        Route::post('group/delete-contacts', 'Admin\smsCampaign\GroupController@postDeleteContactsFromGroup');

        // Route for Contact Group End

        //Route for Campaign sms
        Route::resource('campaign', 'Admin\smsCampaign\sms\CampaignController');
        Route::get('campaigns/to-autocomplete', 'Admin\smsCampaign\sms\CampaignController@getContactAndGroupForAutocomplete');
        Route::post('campaigns/save-message-template', 'Admin\smsCampaign\sms\CampaignController@saveMessageTemplate');
        Route::get('campaigns/get-message-templates', 'Admin\smsCampaign\sms\CampaignController@getMessageTemplates');

        Route::post('campaign/sendBulksms', "Admin\smsCampaign\sms\CampaignController@sendSMS");

        Route::get('message/history', 'Admin\smsCampaign\sms\CampaignController@messageHistory');

        //campaign csv sample download
        Route::get('sampleCsv1/download/{name}', 'Admin\smsCampaign\sms\CampaignController@downloadSample');

        Route::post('template/mass-delete', 'Admin\smsCampaign\sms\TemplateController@postMassDelete');
        Route::delete('/template/destroy/{id}', 'Admin\smsCampaign\sms\TemplateController@destroy')->name('template.destroy');
        Route::resource('template/save', 'Admin\smsCampaign\sms\TemplateController@saveTemplate');
        Route::resource('template', 'Admin\smsCampaign\sms\TemplateController');


        //Route end for Campaign sms

    });
    // Route for Sms Campaign end

	// Route for movies
	Route::group(['prefix'=>'box-office/movies'], function(){
	   Route::get('/', 'Admin\MovieController@movieslist');
	   Route::get('/create','Admin\MovieController@createmovie');
	   Route::post('/submit','Admin\MovieController@submit');
	   Route::get('{movieid}/edit','Admin\MovieController@editmovie');
       Route::get('{movieid}/view','Admin\MovieController@viewmovie');
	   Route::post('update/{movieid}','Admin\MovieController@update');
       Route::get('/delete', 'Admin\MovieController@delete');
       Route::get('addmovieartists','Admin\MovieController@addartistformovie');
	});
    // Route for movies end

    // Route for Artists
    Route::group(['prefix'=>'box-office/artist'], function(){
       Route::get('/', 'Admin\ArtistsController@artistslist');
       Route::get('/create','Admin\ArtistsController@createartist');
       Route::post('/submit','Admin\ArtistsController@submit');
       Route::get('{artistsid}/edit','Admin\ArtistsController@editartist');
       Route::get('{artistsid}/view','Admin\ArtistsController@viewartist');
       Route::post('update/{artistsid}','Admin\ArtistsController@update');
       Route::get('/delete', 'Admin\ArtistsController@delete');

    });
    // Route for artists end


    // Route for Content Management
        Route::group(['prefix'=>'content-management'],function(){

            Route::get('inquiry','Admin\InquiryController@index');
            Route::get('inquiry/delete','Admin\InquiryController@delete');


            Route::get('promotional-banner','Admin\PromotionalBannerController@index');
            Route::get('promotional-banner/create','Admin\PromotionalBannerController@add');
            Route::post('promotional-banner/submit','Admin\PromotionalBannerController@submit');
            Route::get('promotional-banner/{id}/edit','Admin\PromotionalBannerController@edit');
            Route::post('promotional-banner/update/{id}','Admin\PromotionalBannerController@update');
            Route::get('promotional-banner/delete','Admin\PromotionalBannerController@delete');


            Route::get('social-media','Admin\SocialMediaController@index');
            Route::get('social-media/create','Admin\SocialMediaController@create');
            Route::post('social-media/submit','Admin\SocialMediaController@store');
            Route::get('social-media/{id}/edit','Admin\SocialMediaController@edit');
            Route::post('social-media/update/{id}','Admin\SocialMediaController@update');
            Route::get('social-media/delete','Admin\SocialMediaController@destroy');


            Route::get('contact-us','Admin\ContactUsController@index');
            Route::get('contact-us/create','Admin\ContactUsController@create');
            Route::post('contact-us/submit','Admin\ContactUsController@store');
            Route::get('contact-us/{id}/edit','Admin\ContactUsController@edit');
            Route::post('contact-us/update/{id}','Admin\ContactUsController@update');
            Route::get('contact-us/delete','Admin\ContactUsController@destroy');


            Route::get('manage-pages','Admin\ManagePagesController@index');
            Route::get('manage-pages/create','Admin\ManagePagesController@create');
            Route::post('manage-pages/submit','Admin\ManagePagesController@store');
            Route::get('manage-pages/{id}/edit','Admin\ManagePagesController@edit');
            Route::post('manage-pages/update/{id}','Admin\ManagePagesController@update');
            Route::get('manage-pages/delete','Admin\ManagePagesController@destroy');

            // Route For Manage News
            Route::group(['prefix'=>'manage-news'],function(){

                Route::get('manage-category','Admin\ManageCategoryController@index');
                Route::get('manage-category/create','Admin\ManageCategoryController@create');
                Route::post('manage-category/submit','Admin\ManageCategoryController@store');
                Route::get('manage-category/{id}/edit','Admin\ManageCategoryController@edit');
                Route::post('manage-category/update/{id}','Admin\ManageCategoryController@update');
                Route::get('manage-category/delete','Admin\ManageCategoryController@destroy');

                Route::get('news','Admin\NewsController@index');
                Route::get('news/create','Admin\NewsController@create');
                Route::post('news/submit','Admin\NewsController@store');
                Route::get('news/{id}/edit','Admin\NewsController@edit');
                Route::post('news/update/{id}','Admin\NewsController@update');
                Route::get('news/delete','Admin\NewsController@destroy');
            });
            // Route For Manage News End

            Route::get('notification/footer','Admin\NotificationController@index');
            Route::get('notification/footer/create','Admin\NotificationController@create');
            Route::post('notification/footer/submit','Admin\NotificationController@store');
            Route::get('notification/footer/{id}/edit','Admin\NotificationController@edit');
            Route::post('notification/footer/update/{id}','Admin\NotificationController@update');
            Route::get('notification/footer/delete','Admin\NotificationController@destroy');
            Route::get('notification/message','Admin\NotificationController@message');


            Route::get('movie-banner','Admin\MovieBannerController@index');
            Route::get('movie-banner/create','Admin\MovieBannerController@create');
            Route::post('movie-banner/submit','Admin\MovieBannerController@store');
            Route::get('movie-banner/{id}/edit','Admin\MovieBannerController@edit');
            Route::post('movie-banner/update/{id}','Admin\MovieBannerController@update');
            Route::get('movie-banner/delete','Admin\MovieBannerController@delete');

            Route::get('payment-gateway','Admin\PaymentController@index');
            Route::get('payment-gateway/create','Admin\PaymentController@create');
            Route::post('payment-gateway/submit','Admin\PaymentController@store');
            Route::get('payment-gateway/{id}/edit','Admin\PaymentController@edit');
            Route::post('payment-gateway/update/{id}','Admin\PaymentController@update');
            Route::get('payment-gateway/delete','Admin\PaymentController@destroy');
            Route::get('payment-gateway/{id}/api_details','Admin\PaymentController@api_details');
             Route::post('payment-gateway/payment_api_field_live','Admin\PaymentController@payment_api_field_live');
            Route::post('payment_api_update/{id}','Admin\PaymentController@payment_api_update');
             Route::post('payment-gateway/payment_api_field_test','Admin\PaymentController@payment_api_field_test');
            Route::post('payment_api_insert/submit','Admin\PaymentController@payment_api_insert_live');
            Route::post('payment_api_live_note/update/{id}','Admin\PaymentController@payment_api_live_note');
            Route::post('payment_api_test_note/update/{id}','Admin\PaymentController@payment_api_test_note');
             Route::get('payment_api/delete','Admin\PaymentController@payment_api_delete');

        });
    // Route for Content Management Ends



//	Route for screens
    Route::group(['prefix'=>'seat-management'], function() {
        Route::get('screens/create', 'Admin\ScreenController@create');
        Route::post('screens/submit', 'Admin\ScreenController@submit');
        Route::get('screens/delete', 'Admin\ScreenController@delete');
        Route::get('screens/{slug}/edit', 'Admin\ScreenController@edit');
        Route::post('screens/{slug}/update', 'Admin\ScreenController@update');
        Route::get('screens/{slug}/seat', 'Admin\ScreenController@seat');
        Route::get('screens/{slug}/seat/create', 'Admin\ScreenController@createSeat');
        Route::post('screens/{slug}/seat/update', 'Admin\ScreenController@updateSeat');
        Route::get('screens/{slug}/seat/edit', 'Admin\ScreenController@editSeat');
        Route::post('screens/{slug}/seat/submit', 'Admin\ScreenController@submitSeat');
        Route::post('screens/{slug}/seat/ajax-call', 'Admin\ScreenController@ajaxCall');
        Route::get('screens', 'Admin\ScreenController@lists');
    });
//	Route for screens

//    Route for box office ticket types
        Route::group(['prefix'=>'box-office/ticket-types', 'namespace' => 'Admin'], function() {
            Route::get('/', 'TicketTypesController@index');
            Route::get('classes', 'TicketTypesController@ticketClass');
            Route::get('classes/{slug}/edit', 'TicketTypesController@editTicketClass');
            Route::post('classes/{slug}/update', 'TicketTypesController@updateTicketClass');
            Route::get('classes/create', 'TicketTypesController@createTicketClass');
            Route::get('delete-ticket-class', 'TicketTypesController@deleteTicketClass');
            Route::post('submit-ticket-class', 'TicketTypesController@submitTicketClass');
            Route::get('create', 'TicketTypesController@create');
            Route::post('submit', 'TicketTypesController@submit');
            Route::get('getScreenRows', 'TicketTypesController@getScreenRows');
            Route::get('getSequenceNumber', 'TicketTypesController@getSequenceNumber');
            Route::get('{slug}/edit', 'TicketTypesController@editTicketType');
            Route::post('{slug}/update', 'TicketTypesController@updateTicketType');
            Route::get('delete', 'TicketTypesController@deleteTicketType');
        });
//    Route for box office ticket types

    //    Route for box office PCM
    Route::group(['prefix'=>'box-office/price-card-management', 'namespace' => 'Admin'], function() {
        Route::get('/', 'PriceCardController@index');
        Route::get('create', 'PriceCardController@create');
        Route::post('submit', 'PriceCardController@submit');
        Route::get('{slug}/edit', 'PriceCardController@edit');
        Route::post('{slug}/update', 'PriceCardController@update');
        Route::get('delete', 'PriceCardController@delete');
        Route::get('get-seat-categories', 'PriceCardController@getSeatCategories');
    });
    //    Route for box office PCM

     //    Route for CRM
    Route::group(['prefix'=>'crm', 'namespace' => 'Admin'], function() {
        Route::get('/', 'CrmController@index');
        Route::get('user/filter','CrmController@filter');
        Route::get('user/create', 'CrmController@create');
        Route::post('user/submit', 'CrmController@store');
        Route::post('user/import/excel', 'CrmController@importExcel');
        Route::get('user/download', 'CrmController@getDownload');
        Route::get('user/{id}/edit', 'CrmController@edit');
        Route::post('user/{id}/update', 'CrmController@update');
        Route::get('user/delete', 'CrmController@destroy');
        Route::get('user/suspend', 'CrmController@suspend');
        
        //Route::get('get-seat-categories', 'PriceCardController@getSeatCategories');
    });
    //    Route for  Chane Password

      Route::group(['prefix'=>'change_password', 'namespace' => 'Admin'], function() {
        Route::get('/', 'ChangePasswordController@index');
         Route::get('changepassword/oldpassword', 'ChangePasswordController@VerifyPassword');
          Route::post('changepassword/confirmed_password', 'ChangePasswordController@changePassword');
        //Route::get('get-seat-categories', 'PriceCardController@getSeatCategories');
    });

    //    Route for counter-management
    Route::group(['prefix'=>'counter', 'namespace' => 'Admin'], function() {
        Route::get('/', 'CounterController@index');
        Route::get('counteruser/create', 'CounterController@create');
        Route::post('counteruser/submit', 'CounterController@store');
        Route::get('counteruser/{id}/edit', 'CounterController@edit');
        Route::post('counteruser/{id}/update', 'CounterController@update');
        Route::get('counteruser/delete', 'CounterController@destroy');
        Route::get('counteruser/suspend', 'CounterController@suspend');        
    });
    //    Route for counter-manaement


     //    Route for Profile
    Route::group(['prefix'=>'profile', 'namespace' => 'Admin'], function() {
        Route::get('/', 'ProfileController@index');
        Route::post('master/{id}/update','ProfileController@update');
    });
    //    Route for Profile

    //    Route for box office PCM
    Route::group(['prefix'=>'programming', 'namespace' => 'Admin'], function() {
        Route::get('/', 'ProgrammingController@index');
        Route::post('submit', 'ProgrammingController@submit');
        Route::post('update', 'ProgrammingController@update');
        Route::get('delete-schedule', 'ProgrammingController@deleteSchedule');
        Route::get('events', 'ProgrammingController@events');
        Route::get('getScheduleData', 'ProgrammingController@getScheduleData');
        Route::get('get-pricecard-time', 'ProgrammingController@getPriceCardTime');
        Route::get('add-show', 'ProgrammingController@addShow');
        Route::get('add-show/get-pricecard', 'ProgrammingController@getPriceCards');
    });
    
    // Route for coupon
    Route::group(['prefix'=>'coupon'], function() {
        Route::get('/', 'Admin\CouponController@index');
        Route::get('/create', 'Admin\CouponController@create');
        Route::post('/submit', 'Admin\CouponController@store');
        Route::get('{couponid}/edit', 'Admin\CouponController@edit');
        Route::post('update/{couponid}', 'Admin\CouponController@update');
        Route::get('/delete', 'Admin\CouponController@destroy');
    });

       //    Route for Payment Transaction Log
     Route::group(['prefix'=>'payments'], function(){
       Route::get('transactionlog', 'Admin\TransactionLogController@index');
        Route::post('transactionlog/searchByUser', 'Admin\TransactionLogController@searchByUser');
         Route::get('transactionlog/searchByUser', 'Admin\TransactionLogController@index');
         Route::post('transactionlog/searchByPaymentType', 'Admin\TransactionLogController@searchByPaymentType');
         Route::post('transactionlog/searchByState', 'Admin\TransactionLogController@searchByState');
         Route::post('transactionlog/searchByStartdate', 'Admin\TransactionLogController@searchByStartdate');
         Route::post('transactionlog/transactionType', 'Admin\TransactionLogController@show');
    });


      //    Route for Setting
     Route::group(['prefix'=>'settings'], function(){
       Route::get('/', 'Admin\SettingsController@index');
    });
});


//    Routes for counter management
Route::group(['prefix' => 'counter-management', 'namespace' => 'CounterManagement'], function(){
    Route::get('/', 'IndexController@index');
    Route::post('login-validation', 'IndexController@validation');
    Route::group(['middleware' => 'counter'], function (){
        Route::get('dashboard', 'DashboardController@index');
        Route::get('booking', 'BookingController@index');
        Route::post('booking/check-booking', 'BookingController@checkBooking');
        Route::post('booking/remove-booking', 'BookingController@removeBooking');
        Route::post('booking/remove-hold-data', 'BookingController@removeHoldData');
        Route::post('booking/confirm', 'BookingController@confirmBooking');
        Route::get('logout', 'IndexController@logout');
    });

});