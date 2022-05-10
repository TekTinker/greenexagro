<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/alert',  [
    'uses' => '\App\Http\Controllers\UserController@alert',
    'as' => 'alert'
]);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'uses' => '\App\Http\Controllers\UserController@index',
        'as' => 'home'
    ]);

    Route::get('/about-us', [
        'uses' => '\App\Http\Controllers\UserController@aboutUs',
        'as' => 'about_us'
    ]);

    Route::get('/contact-us', [
        'uses' => '\App\Http\Controllers\UserController@contactUs',
        'as' => 'contact_us'
    ]);

    Route::post('/contact-us', [
        'uses' => '\App\Http\Controllers\UserController@postContactMessage',
        'as' => 'user.contact'
    ]);

    Route::get('/career', [
        'uses' => '\App\Http\Controllers\UserController@career',
        'as' => 'career'
    ]);


    Route::get('/products/category/{cat}',  [
        'uses' => '\App\Http\Controllers\UserController@getProducts',
        'as' => 'products',
    ]);

    Route::get('/crop_info/category/{cat}',  [
        'uses' => '\App\Http\Controllers\UserController@getCrops',
        'as' => 'crops',
    ]);

    Route::get('/raw_materials/{cat}',  [
        'uses' => '\App\Http\Controllers\UserController@getRaw',
        'as' => 'raw_materials',
    ]);

    Route::get('/product/details/{id}',  [
        'uses' => '\App\Http\Controllers\UserController@getProductDetails',
        'as' => 'product.details',
    ]);

    Route::get('/crop_info/details/{id}',  [
        'uses' => '\App\Http\Controllers\UserController@getCropDetails',
        'as' => 'crop.details',
    ]);

    Route::get('/search',  [
        'uses' => '\App\Http\Controllers\UserController@getSearchByName',
        'as' => 'product.search',
    ]);

    Route::get('/news/{id}',  [
        'uses' => '\App\Http\Controllers\UserController@getNewsDetails',
        'as' => 'news.details',
    ]);
    
});


Route::group(['middleware' => ['web', 'guest']], function () {



    Route::get('/signup',  [
        'uses' => '\App\Http\Controllers\AuthController@getSignUp',
        'as' => 'auth.signup',
    ]);

    Route::post('/signup',  [
        'uses' => '\App\Http\Controllers\AuthController@postSignUp',
    ]);

    Route::get('/login',  [
        'uses' => '\App\Http\Controllers\AuthController@getLogin',
        'as' => 'auth.login',
    ]);

    Route::post('/login',  [
        'uses' => '\App\Http\Controllers\AuthController@postLogin',
    ]);


    Route::get('/forgot',  [
        'uses' => '\App\Http\Controllers\AuthController@getForgotPage',
        'as' => 'auth.forgot',
    ]);

    Route::post('/forgot',  [
        'uses' => '\App\Http\Controllers\AuthController@postForgotPage',        
    ]);
    

    Route::get('/reset',  [
        'uses' => '\App\Http\Controllers\AuthController@getResetPage',
        'as' => 'auth.reset',
    ]);

    Route::post('/reset',  [
        'uses' => '\App\Http\Controllers\AuthController@postResetPage',
    ]);

});


Route::group(['middleware' => ['web', 'auth']], function () {


    Route::get('/logout',  [
        'uses' => '\App\Http\Controllers\AuthController@getLogout',
        'as' => 'auth.logout'
    ]);

    Route::get('/account/add_farms_on_signUp',  [
        'uses' => '\App\Http\Controllers\UserController@getAddFarmsOnSignUp',
        'as' => 'customer.sign_up.add_farms'
    ]);
    
    

    Route::get('/account',  [
        'uses' => '\App\Http\Controllers\UserController@getAccount',
        'as' => 'user.account',
    ]);


    Route::get('/account/profile',  [
        'uses' => '\App\Http\Controllers\UserController@getAccountEditProfile',
        'as' => 'user.account.edit_profile',
    ]);

    Route::post('/account/profile',  [
        'uses' => '\App\Http\Controllers\UserController@postAccountEditProfile',
        'as' => 'user.account.edit_profile',
    ]);

    Route::get('/account/profile/password',  [
        'uses' => '\App\Http\Controllers\UserController@getAccountEditPassword',
        'as' => 'user.account.edit_password',
    ]);

    Route::post('/account/profile/password',  [
        'uses' => '\App\Http\Controllers\UserController@postAccountEditPassword',
    ]);


    Route::get('/cart',  [
        'uses' => '\App\Http\Controllers\UserController@getCart',
        'as' => 'user.cart'
    ]);

    Route::get('/account/order/details/{id}', [
        'uses' => '\App\Http\Controllers\UserController@getOrderDetails',
        'as' => 'order.details'
    ]);

    Route::get('/account/farms',  [
        'uses' => '\App\Http\Controllers\UserController@getFarms',
        'as' => 'customer.account.farms',
    ]);

    Route::post('/account/farms/{signUp}',  [
        'uses' => '\App\Http\Controllers\UserController@postFarmAdd',
        'as' => 'customer.account.farms.add',
    ]);

    Route::post('/account/farms/delete/{signUp}/{id}',  [
        'uses' => '\App\Http\Controllers\UserController@postFarmDelete',
        'as' => 'customer.account.farms.delete',
    ]);


    Route::get('/account/orders', [
        'uses' => '\App\Http\Controllers\UserController@getOrders',
        'as' => 'customer.account.orders',
    ]);


    Route::post('/cart/add', [
        'uses' => '\App\Http\Controllers\UserController@postAddToCart',
        'as' => 'user.cart.add_to_cart',
    ]);

    Route::post('/cart/{action}', [
        'uses' => '\App\Http\Controllers\UserController@postCheckout',
        'as' => 'user.checkout',
    ]);

    Route::get('/checkout', [
        'uses' => '\App\Http\Controllers\UserController@getCheckoutPage',
        'as' => 'user.checkoutpage',
    ]);

    Route::post('/checkout', [
        'uses' => '\App\Http\Controllers\UserController@postCheckoutPage',
        'as' => 'user.checkoutpage',
    ]);



});


Route::group(['middleware' => ['web', 'auth', 'admin']], function () {


    /*
     * Notification management routes
     */
    Route::get('/admin/notifications',  [
        'uses' => '\App\Http\Controllers\AdminController@getNotificationsAdd',
        'as' => 'admin.notifications.add',
    ]);

    Route::post('/admin/notifications',  [
        'uses' => '\App\Http\Controllers\AdminController@postNotificationsAdd',
    ]);

    Route::get('/admin/notifications/list',  [
        'uses' => '\App\Http\Controllers\AdminController@getNotificationsList',
        'as' => 'admin.notifications.list',
    ]);

    Route::get('/notification/edit/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@getNotificationEdit',
        'as' => 'admin.notifications.edit',
    ]);

    Route::post('/notification/edit/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postNotificationEdit',
        'as' => 'admin.notifications.edit',
    ]);

    Route::post('/notification/delete/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postNotificationDelete',
        'as' => 'admin.notifications.delete',
    ]);



    

    /*
     * Order management routes
     */

    Route::get('/admin/orders',  [
        'uses' => '\App\Http\Controllers\AdminController@getOrdersPage',
        'as' => 'admin.orders',
    ]);

    Route::get('/admin/issued_orders',  [
        'uses' => '\App\Http\Controllers\AdminController@getOrdersIssuedPage',
        'as' => 'admin.issued_orders',
    ]);

    Route::post('/admin/orders/{order_id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postOrderIssue',
        'as' => 'admin.order.issue',
    ]);

    Route::post('/admin/issued_orders/{order_id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postOrderActivate',
        'as' => 'admin.issued_orders.activate',
    ]);

    Route::get('/admin/issued_orders/search',  [
        'uses' => '\App\Http\Controllers\AdminController@getOrdersIssuedPageSearch',
        'as' => 'admin.issued_orders.search',
    ]);

    Route::get('/admin/orders/search',  [
        'uses' => '\App\Http\Controllers\AdminController@getOrdersPageSearch',
        'as' => 'admin.orders.search',
    ]);
    
    
    

    /*
     * Employee management routes
     */
    Route::get('/admin/employees',  [
        'uses' => '\App\Http\Controllers\AdminController@getEmployeePage',
        'as' => 'admin.employees',
    ]);

    Route::get('/admin/employee/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@getEmployeeProfile',
        'as' => 'admin.employee.view',
    ]);

    Route::post('/admin/employees/approve/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postEmployeeApprove',
        'as' => 'admin.employee.approve',
    ]);

    Route::post('/admin/employees/delete/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postEmployeeDelete',
        'as' => 'admin.employee.delete',
    ]);

    Route::post('/admin/employees/disable/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postEmployeeDisable',
        'as' => 'admin.employee.disable',
    ]);


    /*
     * Customer management routes
     */
    Route::get('/admin/customers',  [
        'uses' => '\App\Http\Controllers\AdminController@getCustomerPage',
        'as' => 'admin.customers',
    ]);

    Route::get('/admin/customer/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@getCustomerProfile',
        'as' => 'admin.customer.view',
    ]);

    Route::get('/admin/customers/search', [
        'uses' => '\App\Http\Controllers\AdminController@getCustomerSearchPage',
        'as' => 'admin.customers.search',
    ]);
    


    /*
     * Consultant management routes
     */
    Route::get('/admin/consultants',  [
        'uses' => '\App\Http\Controllers\AdminController@getConsultantPage',
        'as' => 'admin.consultants',
    ]);

    Route::get('/admin/consultant/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@getConsultantProfile',
        'as' => 'admin.consultant.view',
    ]);

    Route::get('/admin/consultants/search', [
        'uses' => '\App\Http\Controllers\AdminController@getConsultantSearchPage',
        'as' => 'admin.consultants.search',
    ]);


    /*
     * Product management routes.
     */

    Route::get('/admin/account',  [
        'uses' => '\App\Http\Controllers\AdminController@getAccount',
        'as' => 'admin.account',
    ]);

    Route::get('/admin/product/add/{type}',  [
        'uses' => '\App\Http\Controllers\AdminController@getAddProduct',
        'as' => 'admin.product.add',
    ]);

    Route::post('/admin/product/add/{type}',  [
        'uses' => '\App\Http\Controllers\AdminController@postAddProduct',
    ]);

    Route::get('/admin/product/{id}/packages',  [
        'uses' => '\App\Http\Controllers\AdminController@getProductPackages',
        'as' => 'admin.product.packages',
    ]);

    Route::post('/admin/product/{id}/packages',  [
        'uses' => '\App\Http\Controllers\AdminController@postProductPackages',
    ]);

    Route::post('/admin/product/package/toggle/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postProductPackagesToggle',
        'as' => 'admin.product.packages.toggle',
    ]);

    Route::post('/admin/product/package/delete/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postProductPackagesDelete',
        'as' => 'admin.product.packages.delete',
    ]);

    Route::post('/admin/product/{id}/packages',  [
        'uses' => '\App\Http\Controllers\AdminController@postProductPackagesAdd',
        'as' => 'admin.product.packages.add',
    ]);

    Route::get('/admin/product/categories',  [
        'uses' => '\App\Http\Controllers\AdminController@getCategories',
        'as' => 'admin.product.categories',
    ]);

    Route::post('/admin/product/categories/toggle/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postCategoryToggle',
        'as' => 'admin.product.categories.toggle',
    ]);

    Route::post('/admin/product/categories/delete/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postCategoryDelete',
        'as' => 'admin.product.categories.delete',
    ]);

    Route::post('/admin/product/categories/add',  [
        'uses' => '\App\Http\Controllers\AdminController@postCategoryAdd',
        'as' => 'admin.product.categories.add',
    ]);

    Route::get('/admin/product/edit',  [
        'uses' => '\App\Http\Controllers\AdminController@getEditProduct',
        'as' => 'admin.product.edit',
    ]);

    Route::get('/admin/product/edit/search',  [
        'uses' => '\App\Http\Controllers\AdminController@getEditProductSearch',
        'as' => 'admin.product.edit.search',
    ]);

    Route::get('/admin/product/edit/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@getEditProductSingle',
        'as' => 'admin.product.edit.single',
    ]);

    Route::post('/admin/product/edit/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postEditProductSingle',
        'as' => 'admin.product.edit.single',
    ]);

    Route::post('/admin/product/edit/status/{id}',  [
        'uses' => '\App\Http\Controllers\AdminController@postProductStatusToggle',
        'as' => 'admin.product.edit.status.toggle',
    ]);



});