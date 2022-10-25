<?php 

//نظرات
Route::resource('comment', 'CommentController');
// امتیازات
Route::resource('like', 'LikeController');
// مشاوره
Route::resource('consultation', 'ConsultationController');
// پروفایل مشاور
Route::resource('show-video', 'VideoController');
Route::get('consultation/profile/{id}', 'ConsultationController@profile')->name('consultation.profile');
Route::get('consultation/profile/teacher/{id}/{package}', 'ConsultationController@profile2')->name('consultation.profile2');
Route::get('consultation/profile/workshop/{id}/{package}', 'ConsultationController@profile3')->name('consultation.profile3');
Route::get('consultation/profile/startup/{id}/', 'ConsultationController@profile4')->name('consultation.profile4');
Route::get('consultation/startup/show/{id}', 'ConsultationController@startup')->name('consultation.startup');
// زیر دسته های اصلی
Route::get('consultation/category/{slug}', 'ConsultationController@index')->name('consultation.category');
// انلاین شد خبرم کن
Route::get('consultation/offline/evoke/{consultation_id}', 'ConsultationController@evoke')->name('consultation.evoke');
// دعوت به همکاری
Route::resource('cooperation', 'CooperationController');
// بلاگ , آموزش و اطلاعیه
Route::get('post/type/{id}', 'BlogController@index')->name('post.index.type');
Route::resource('post', 'BlogController');
// فرم های مشاوره
Route::resource('forms', 'FormController');
// اعلانات و ارسال پیام به کاربران
Route::resource('notification', 'NotificationController');
Route::get('/', 'GuestController@index')->name('home-goust');
// نصب اپلیکیشن
Route::get('/pwa', 'GuestController@create')->name('home-guost-pwa');
Route::get('/app/pwa', 'GuestController@app')->name('home-guost-app-pwa');
// بخش اپلیکیشن
Route::get('/app', 'HomeController@index')->name('index');
Route::get('/services/{cat_id}', 'HomeController@services')->name('services');
Route::get('/groups/{cat_id}', 'HomeController@subServices')->name('subServices');
Route::get('/groups/special/{cat_id}', 'HomeController@subServices2')->name('subServices2');
Route::get('/service/{id}/{slug}', 'HomeController@service')->name('service');
Route::get('/packages_category', 'HomeController@packages_category')->name('package.category');
Route::get('/packages', 'HomeController@packages')->name('packages');
Route::get('/package/{slug}', 'HomeController@package')->name('package');
Route::get('/reserve/{type}/{slug}', 'HomeController@reserve')->name('reserve');
Route::post('/validation-email', 'HomeController@validation_email')->name('validation.email');
Route::get('/login-package-buy/{slug}/{price_id?}', 'HomeController@login_package_buy')->name('login.package.buy');
Route::get('/package-buy', 'HomeController@package_buy')->name('package.buy');
Route::get('/off_check/{code}/{price}', 'HomeController@off_check')->name('off.check');
 
//bascket 
Route::get('/basket/view', 'BasketController@index')->name('basket_index');
Route::get('/add_basket/{id}/{type}', 'BasketController@add_basket')->name('add_basket');
Route::post('/add_basket/{id}/{type}', 'BasketController@add_basket')->name('add_basket_with_offCode');
Route::get('/level_1', 'BasketController@level_1')->name('basket.list');
Route::post('/level_2', 'BasketController@level_2')->name('basket.pay');
Route::get('/basket_del/{id}/{type}', 'BasketController@del_basket')->name('basket.del');
Route::resource('my-basket', 'BasketController');
/*Route::get('/basket_del', 'BasketController@del_basket')->name('basket.del');*/

Route::get('report/user-transaction/{id}', 'TransactionController@index')->name('user-transaction-report');
// app pay
Route::resource('user-transaction', 'TransactionController');
// web pay
Route::resource('user-web-transaction', 'WebTransactionController');
Route::get('ads/tours/{name}', 'TourAdsController@show')->name('ads-tours-show-guest');
Route::get('ads/tours/{name}/edit', 'TourAdsController@edit')->name('admin-ads-tours-filter');
Route::get('ads/tours/service-destroy/{id}', 'TourAdsController@destroy')->name('admin-ads-tours-service-destroy');
Route::get('ads/tours/filter/{id}', 'TourAdsController@index')->name('ads-tours-index-filter');
Route::resource('user-tours', 'TourAdsController');
Route::resource('sign-up-using-website', 'SiteRegisterController');
Route::resource('sign-up-using-mobile', 'NewRegisterController');
Route::get('sign-up-using-website/remember/password', 'SiteRegisterController@remember_password')->name('sign-up-using-website.remember-password');
Route::get('sign-up-using-mobile/remember/password', 'NewRegisterController@remember_password')->name('sign-up-using-mobile.remember-password');
Route::post('sign-up-using-website/resend/password', 'SiteRegisterController@resend_password')->name('sign-up-using-website.resend-password');
Route::post('sign-up-using-mobile/resend/password', 'NewRegisterController@resend_password')->name('sign-up-using-mobile.resend-password');
Route::resource('my-user', 'UserController');
Route::get('user/search/services', 'SearchController@search')->name('services-search'); 

// ticket 
Route::get('user/show/tikects', 'HomeController@tickets')->name('tickets'); 
Route::get('user/web/show/tikects', 'HomeController@web_tickets')->name('web-tickets'); 
Route::get('user/show/tikect/{id}', 'HomeController@show_ticket')->name('show-ticket'); 
Route::get('user/web/show/tikect/{id}', 'HomeController@web_show_ticket')->name('web-show-ticket'); 

//register
Route::get('user-register/{code}', 'RegisterController@register')->name('register'); 
Route::get('agent-register', 'RegisterController@agent')->name('agent.register');
Route::get('user-register', 'RegisterController@mobile')->name('mobile');
Route::post('mobile-post', 'RegisterController@mobile_post')->name('mobile.post');
Route::get('verify-code', 'RegisterController@verify')->name('verify');
Route::post('verify-code-post', 'RegisterController@verify_post')->name('verify.post');
Route::get('complete', 'RegisterController@complete')->name('complete');
Route::post('complete-post', 'RegisterController@complete_post')->name('complete.post');
Route::get('complete-agent', 'RegisterController@complete_agent')->name('complete.agent');
Route::post('complete-agent-post', 'RegisterController@complete_agent_post')->name('complete.agent.post');

//reset password
Route::get('user-reset-password', 'PasswordController@reset_password_show')->name('reset.password.show');
Route::post('user-reset-password-post', 'PasswordController@reset_password_post')->name('reset.password.post');
Route::get('verify-reset-password', 'PasswordController@reset_password_verify')->name('reset.password.verify');
Route::post('verify-reset-password-post', 'PasswordController@reset_password_verify_post')->name('reset.password.verify.post');
Route::get('new-password', 'PasswordController@new_password')->name('new.password');
Route::post('new-password-post', 'PasswordController@new_password_post')->name('new.password.post');

// contact us
Route::get('contact-us', 'ContactController@show')->name('contact.show');
// Route::post('contact-us-post', 'ContactController@form_post')->name('contact.post');
Route::post('contact-us-post', 'TicketController@form_post')->name('contact.post');

// guide user
Route::get('about-us', 'AboutController@show')->name('about.show');
Route::get('about', 'AboutController@index')->name('about.index');

// guide user
Route::get('guide-user', 'GuideController@show')->name('guide.show');

// rules
Route::get('rules', 'RuleController@show')->name('rule.show');

// agent
Route::get('agent-rule', 'AgentController@show')->name('agent.rule.show');
Route::post('agent-request', 'AgentController@agent_request')->name('agent.request');

//zarin pal
Route::any('zarinpal-pay/{id}/{total}/{user}/{type}', 'ZarinpalController@pay')->name('zarinpal-pay-user');
Route::any('zarinpal-verify', 'ZarinpalController@verify')->name('verify_user');
//zarin pal new
Route::any('zarinpal-pay-new/{factor_id}/{user_id}', 'ZarinpalNewController@pay')->name('zarinpal.pay.new');
Route::any('zarinpal-verify-new', 'ZarinpalNewController@verify')->name('verify.new');

//refah
Route::any('refah-pay/{id}/{type}', 'RefahController@pay')->name('refah.pay');
Route::any('refah-verify', 'RefahController@verify')->name('refah.verify');


Route::view('questions','user.questions')->name('questions');
// Route::view('services','user.services')->name('services');

//calling
Route::get('call/user/web/call/report', 'CallController@user_call_report')->name('call.user_call_report');
Route::get('call/user/app/call/report', 'CallController@app_user_call_report')->name('app.call.user_call_report');
Route::get('call/{id}/{type}/request', 'CallController@request')->name('call.request');
Route::get('call/{unique_code}', 'CallController@index')->name('call.index');
Route::get('call/{unique_code}/accept/{status}', 'CallController@accept')->name('call.accept');
Route::get('call/{unique_code}/end', 'CallController@end')->name('call.end');
Route::get('call/{unique_code}/no_reply', 'CallController@no_reply')->name('call.no.reply');


