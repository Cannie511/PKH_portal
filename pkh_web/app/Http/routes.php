<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

// $DOMAIN_MAIN     = env('DOMAIN_MAIN', 'mysite.local');
// $DOMAIN_WWW      = $DOMAIN_MAIN;
// $DOMAIN_ADMIN    = env('DOMAIN_ADMIN', 'admin.mysite.local');
// $DOMAIN_CUSTOMER = env('DOMAIN_CUSTOMER', 'customer.mysite.local');

function routeForFrontend() {
    $prefix = 'frontend';
    // Route::get('/', ['as' => $prefix . '.home', 'uses' => 'PageController@home']);
    Route::get('/lien-he', ['uses' => 'ContactController@index']);
    Route::post('/lien-he', ['uses' => 'ContactController@send']);
    Route::get('/san-pham-moi', ['uses' => 'ProductController@newList']);
    Route::get('/bang-gia/{month}', ['uses' => 'ProductController@priceList']);
    Route::get('/bao-hanh/{code}', ['uses' => 'ProductController@getGuarantee'])->where('code', '(WT|wt)[0-9a-zA-Z]{4}');
    Route::post('/bao-hanh/{code}', ['uses' => 'ProductController@postGuarantee'])->where('code', '(WT|wt)[0-9a-zA-Z]{4}');
    Route::get('/danh-muc-san-pham', ['uses' => 'ProductController@all']);
    Route::get('/danh-muc/{slug}/{code}', ['uses' => 'ProductController@getCat']);
    Route::get('/tin-tuc', ['uses' => 'NewsController@index']);
    Route::get('/tin-tuc/{slug}', ['uses' => 'NewsController@getShow']);
    Route::get('/tin-tuc/preview/{slug}', ['uses' => 'NewsController@getPreview']);
    Route::get('/tin-tuc/preview-id/{id}', ['uses' => 'NewsController@getPreviewById']);
    Route::get('/images/{path}', '\App\Http\Controllers\ImageController@getImageWeb')
        ->where('path', '(.*)');

    Route::get('/dat-hang', ['uses' => 'OrderController@getShow', 'as' => 'dathang']);
    Route::get('/chi-tiet/{id}', ['uses' => 'OrderController@getShowDetail']);
    Route::post('/tao-don-hang', ['uses' => 'OrderController@postMakeOrder']);

    Route::get('/san-pham', ['uses' => 'OrderController@getProductList']);
    Route::get('/san-pham/{slug}/{code}', ['uses' => 'ProductController@getProduct']);
    Route::get('/gio-hang', ['uses' => 'OrderController@getAddCart']);
    // Route::get('/download/one/{token}', ['uses' => 'DownloadController@getDownloadOneTime']);
    Route::get('/', ['uses' => 'Page2Controller@home']);
    // Route::get('/print-qr', ['uses' => 'Page2Controller@printQr']);
    Route::post('/print-qr', ['uses' => 'Page2Controller@printQr']);
    Route::get('/don-hang', ['uses' => 'OrderStatusController@index']);
    Route::get('/{slug}', ['uses' => 'Page2Controller@show']);

    // Route::get('/{slug}', ['uses' => 'PageController@show']);
}

/**
 * Frontend Site
 */
// Route::group(['domain' => $DOMAIN_WWW, 'namespace' => 'Frontend', 'middleware' => ['web']], function () {
//     routeForFrontend();
// });

// Route::group(['domain' => 'www.watertec.com.vn', 'namespace' => 'Frontend', 'middleware' => ['web']], function () {
//     routeForFrontend();
// });

// Route::group(['domain' => 'watertec.com.vn', 'namespace' => 'Frontend', 'middleware' => ['web']], function () {
//     routeForFrontend();
// });

/**
 * Portal Admin Site
 */
// Route::group(['domain' => $DOMAIN_ADMIN, 'namespace' => 'Admin', 'middleware' => ['web']], function () {
Route::group(['namespace' => 'Admin', 'middleware' => ['web']], function () {

    Route::get('/', 'AngularController@serveApp');
    Route::get('/unsupported-browser', 'AngularController@unsupported');

    Route::get('user/verify/{verificationCode}', ['uses' => '\App\Http\Controllers\Auth\AuthController@verifyUserEmail']);
    Route::get('auth/{provider}', ['uses' => '\App\Http\Controllers\Auth\AuthController@redirectToProvider']);
    Route::get('auth/{provider}/callback', ['uses' => '\App\Http\Controllers\Auth\AuthController@handleProviderCallback']);
    Route::get('/api/authenticate/user', '\App\Http\Controllers\Auth\AuthController@getAuthenticatedUser');

    Route::get('/download/one/{token}', ['uses' => '\App\Http\Controllers\FileController@getFileOneTime']);

    Route::get('/pdf/{path}', '\App\Http\Controllers\FileController@getPdf')
        ->where('path', '(.*)');

    Route::get('/images/{screen}/{path}', '\App\Http\Controllers\ImageController@getImage')
        ->where('path', '(.*)');

    Route::get('/views/{viewName}', '\App\Http\Controllers\ViewController@view')
        ->where('viewName', '(.*)');
});

/**
 * Customer Site
 */
// Route::group(['domain' => $DOMAIN_CUSTOMER, 'namespace' => 'Customer', 'middleware' => ['web']], function () {

//     Route::get('/', 'AngularController@serveApp');
//     Route::get('/unsupported-browser', 'AngularController@unsupported');

//     Route::get('user/verify/{verificationCode}', ['uses' => '\App\Http\Controllers\Auth\AuthController@verifyUserEmail']);
//     Route::get('auth/{provider}', ['uses' => '\App\Http\Controllers\Auth\AuthController@redirectToProvider']);
//     Route::get('auth/{provider}/callback', ['uses' => '\App\Http\Controllers\Auth\AuthController@handleProviderCallback']);
//     Route::get('/api/authenticate/user', '\App\Http\Controllers\Auth\AuthController@getAuthenticatedUser');
// });

/**
 * API
 */
$api->group(['middleware' => ['api']], function ($api) {
    $api->controller('auth', 'Auth\AuthController');

    // Password Reset Routes...
    $api->post('auth/password/email', 'Auth\PasswordResetController@sendResetLinkEmail');
    $api->get('auth/password/verify', 'Auth\PasswordResetController@verify');
    $api->post('auth/password/reset', 'Auth\PasswordResetController@reset');
});

$apiGroupSeeting = [];

// if (env('APP_ENV', '') == 'local') {
//     $apiGroupSeeting = ['middleware' => ['api', 'api.auth', 'permission:domain.portal']];
// } else {
//     $apiGroupSeeting = ['domain' => $DOMAIN_ADMIN, 'middleware' => ['api', 'api.auth', 'permission:domain.portal']];
// }
$apiGroupSeeting = ['middleware' => ['api', 'api.auth']];

$api->group($apiGroupSeeting, function ($api) {

    $api->get('users/me', 'Admin\UserController@getMe');
    $api->put('users/me', 'Admin\UserController@putMe');

    $api->post('logout', '\App\Http\Controllers\Auth\AuthController@postLogout');

    $api->controller('suppliers', 'Admin\SupplierController');

   

    $api->controller('crm0510', 'Admin\Crm0510Controller'); // Customer service
    $api->controller('crm0500', 'Admin\Crm0500Controller'); // Customer service
    $api->controller('crm2400', 'Admin\Crm2400Controller'); // Danh sách yêu cầu xử lý đơn hàng
    $api->controller('crm0351', 'Admin\Crm0351Controller'); // Chành xe
    $api->controller('crm0350', 'Admin\Crm0350Controller');
    $api->controller('crm4000', 'Admin\Crm4000Controller');
    $api->controller('crm2300', 'Admin\Crm2300Controller');
    $api->controller('crm2310', 'Admin\Crm2310Controller');
    $api->controller('crm2320', 'Admin\Crm2320Controller');
    $api->controller('crm2330', 'Admin\Crm2330Controller');
    $api->controller('crm2100', 'Admin\Crm2100Controller');
    $api->controller('crm2110', 'Admin\Crm2110Controller');
    $api->controller('crm2000', 'Admin\Crm2000Controller');
    $api->controller('crm2010', 'Admin\Crm2010Controller');
    $api->controller('crm0740', 'Admin\Crm0740Controller');
    $api->controller('crm0340', 'Admin\Crm0340Controller');
    $api->controller('crm1650', 'Admin\Crm1650Controller');
    $api->controller('crm0100', 'Admin\Crm0100Controller');
    $api->controller('crm0110', 'Admin\Crm0110Controller');
    $api->controller('crm0120', 'Admin\Crm0120Controller');
    $api->controller('crm0121', 'Admin\Crm0121Controller');
    $api->controller('crm1700', 'Admin\Crm1700Controller');
    $api->controller('crm1900', 'Admin\Crm1900Controller');
    $api->controller('crm1920', 'Admin\Crm1920Controller');
    $api->controller('crm1921', 'Admin\Crm1921Controller');
    $api->controller('crm1810', 'Admin\Crm1810Controller');
    $api->controller('crm1811', 'Admin\Crm1811Controller');
    $api->controller('crm1820', 'Admin\Crm1820Controller');
    $api->controller('crm1821', 'Admin\Crm1821Controller');
    $api->controller('crm1830', 'Admin\Crm1830Controller');
    $api->controller('crm1831', 'Admin\Crm1831Controller');
    $api->controller('crm1710', 'Admin\Crm1710Controller');
    $api->controller('crm1620', 'Admin\Crm1620Controller');
    $api->controller('crm1610', 'Admin\Crm1610Controller');
    $api->controller('crm1630', 'Admin\Crm1630Controller');
    $api->controller('crm1640', 'Admin\Crm1640Controller');
    $api->controller('crm1600', 'Admin\Crm1600Controller');
    $api->controller('crm1500', 'Admin\Crm1500Controller');
    $api->controller('crm1510', 'Admin\Crm1510Controller');
    $api->controller('crm0130', 'Admin\Crm0130Controller');
    $api->controller('crm0140', 'Admin\Crm0140Controller');
    $api->controller('crm0200', 'Admin\Crm0200Controller');
    $api->controller('crm0210', 'Admin\Crm0210Controller');
    $api->controller('crm0220', 'Admin\Crm0220Controller');
    $api->controller('crm0230', 'Admin\Crm0230Controller');
    $api->controller('crm0231', 'Admin\Crm0231Controller');
    $api->controller('crm0240', 'Admin\Crm0240Controller');
    $api->controller('crm0250', 'Admin\Crm0250Controller');
    $api->controller('crm0300', 'Admin\Crm0300Controller');
    $api->controller('crm0301', 'Admin\Crm0301Controller');
    $api->controller('crm0310', 'Admin\Crm0310Controller');
    $api->controller('crm0320', 'Admin\Crm0320Controller');
    $api->controller('crm0321', 'Admin\Crm0321Controller');
    $api->controller('crm0330', 'Admin\Crm0330Controller');
    $api->controller('crm0331', 'Admin\Crm0331Controller');
    $api->controller('crm0400', 'Admin\Crm0400Controller');
    $api->controller('crm0410', 'Admin\Crm0410Controller');
    $api->controller('crm1310', 'Admin\Crm1310Controller');
    $api->controller('crm1300', 'Admin\Crm1300Controller');
    $api->controller('crm0700', 'Admin\Crm0700Controller');
    $api->controller('crm0710', 'Admin\Crm0710Controller');
    $api->controller('crm0720', 'Admin\Crm0720Controller');
    $api->controller('crm0750', 'Admin\Crm0750Controller');
    $api->controller('crm0751', 'Admin\Crm0751Controller');
    $api->controller('crm1210', 'Admin\Crm1210Controller');
    $api->controller('crm1200', 'Admin\Crm1200Controller');
    $api->controller('crm0800', 'Admin\Crm0800Controller');
    $api->controller('crm0810', 'Admin\Crm0810Controller');
    $api->controller('crm0900', 'Admin\Crm0900Controller');
    $api->controller('crm0910', 'Admin\Crm0910Controller');
    $api->controller('crm0912', 'Admin\Crm0912Controller');
    $api->controller('crm0913', 'Admin\Crm0913Controller');
    $api->controller('crm0914', 'Admin\Crm0914Controller');
    $api->controller('crm0915', 'Admin\Crm0915Controller');
    $api->controller('crm0920', 'Admin\Crm0920Controller');
    $api->controller('crm1010', 'Admin\Crm1010Controller');
    $api->controller('crm1000', 'Admin\Crm1000Controller');
    $api->controller('crm1100', 'Admin\Crm1100Controller');
    $api->controller('crm2520', 'Admin\Crm2520Controller');
    $api->controller('crm2521', 'Admin\Crm2521Controller');
    $api->controller('crm1110', 'Admin\Crm1110Controller');
    
    $api->controller('crm2500', 'Admin\Crm2500Controller');
    $api->controller('crm2510', 'Admin\Crm2510Controller');
    $api->controller('crm2530', 'Admin\Crm2530Controller');
    $api->controller('crm2540', 'Admin\Crm2540Controller');
    $api->controller('crm2550', 'Admin\Crm2550Controller');
    $api->controller('crm2600', 'Admin\Crm2600Controller'); // Chi tiết cửa hàng
    $api->controller('crm2601', 'Admin\Crm2601Controller'); // Chi tiết cửa hàng (Store information)
    $api->controller('crm2610', 'Admin\Crm2610Controller'); // Sản phẩm cửa hàng
    $api->controller('crm2700', 'Admin\Crm2700Controller'); // Danh sách bảo hành
    $api->controller('crm2710', 'Admin\Crm2710Controller'); // In QR code
    $api->controller('crm2800', 'Admin\Crm2800Controller'); // Danh sách KPI của hàng
    $api->controller('crm2810', 'Admin\Crm2810Controller'); // Danh sách KPI 1 của hàng
    $api->controller('crm2820', 'Admin\Crm2820Controller'); // Chi tiết KPI của hàng 1 tháng
    $api->controller('crm2900', 'Admin\Crm2900Controller'); 
    $api->controller('crm2910', 'Admin\Crm2910Controller');
    $api->controller('crm3000', 'Admin\Crm3000Controller'); // Đánh giá cửa hàng
    $api->controller('crm3010', 'Admin\Crm3010Controller'); //Mã chưa mua
    $api->controller('crm3020', 'Admin\Crm3020Controller');
    
    $api->controller('cms0400', 'Admin\Cms0400Controller');
    $api->controller('cms0300', 'Admin\Cms0300Controller');
    $api->controller('cms0100', 'Admin\Cms0100Controller');
    $api->controller('cms0200', 'Admin\Cms0200Controller');
    $api->controller('cms0210', 'Admin\Cms0210Controller');
    $api->controller('cms0220', 'Admin\Cms0220Controller');

    $api->controller('hrm0100', 'Admin\Hrm0100Controller');
    $api->controller('hrm0110', 'Admin\Hrm0110Controller');
    $api->controller('hrm0120', 'Admin\Hrm0120Controller');
    $api->controller('hrm0130', 'Admin\Hrm0130Controller');
    $api->controller('hrm0140', 'Admin\Hrm0140Controller');
    $api->controller('hrm0141', 'Admin\Hrm0141Controller');
    $api->controller('hrm0150', 'Admin\Hrm0150Controller');
    $api->controller('hrm0151', 'Admin\Hrm0151Controller');
    $api->controller('hrm0152', 'Admin\Hrm0152Controller');
    $api->controller('hrm0153', 'Admin\Hrm0153Controller');
    $api->controller('hrm0154', 'Admin\Hrm0154Controller');
    $api->controller('hrm0200', 'Admin\Hrm0200Controller');
    $api->controller('hrm0210', 'Admin\Hrm0210Controller');

    $api->controller('hrm0300', 'Admin\Hrm0300Controller');
    $api->controller('hrm0310', 'Admin\Hrm0310Controller');
    $api->controller('hrm0400', 'Admin\Hrm0400Controller');
    $api->controller('hrm0410', 'Admin\Hrm0410Controller');
    $api->controller('hrm0500', 'Admin\Hrm0500Controller');
    $api->controller('hrm0510', 'Admin\Hrm0510Controller');
    $api->controller('hrm0600', 'Admin\Hrm0600Controller');
    $api->controller('hrm0700', 'Admin\Hrm0700Controller');
    $api->controller('hrm0710', 'Admin\Hrm0710Controller');
    $api->controller('hrm0711', 'Admin\Hrm0711Controller');
    $api->controller('hrm0714', 'Admin\Hrm0714Controller');
    $api->controller('hrm0715', 'Admin\Hrm0715Controller');
    $api->controller('hrm0716', 'Admin\Hrm0716Controller');
    $api->controller('hrm0800', 'Admin\Hrm0800Controller');
    $api->controller('hrm0810', 'Admin\Hrm0810Controller');
    $api->controller('hrm0900', 'Admin\Hrm0900Controller');
    $api->controller('hrm0910', 'Admin\Hrm0910Controller');
    $api->controller('hrm1000', 'Admin\Hrm1000Controller');
    $api->controller('hrm1010', 'Admin\Hrm1010Controller');
    $api->controller('hrm1020', 'Admin\Hrm1020Controller');
    $api->controller('hrm1021', 'Admin\Hrm1021Controller');
    $api->controller('hrm1100', 'Admin\Hrm1100Controller');
    $api->controller('hrm1110', 'Admin\Hrm1110Controller');
    $api->controller('hrm1111', 'Admin\Hrm1111Controller');
    $api->controller('hrm1112', 'Admin\Hrm1112Controller');
    $api->controller('hrm1120', 'Admin\Hrm1120Controller');
    $api->controller('hrm1130', 'Admin\Hrm1100Controller');

    $api->controller('das0100', 'Admin\Das0100Controller');

    $api->controller('rpt0100', 'Admin\Rpt0100Controller');
    $api->controller('rpt0200', 'Admin\Rpt0200Controller');
    $api->controller('rpt0510', 'Admin\Rpt0510Controller');
    $api->controller('rpt0511', 'Admin\Rpt0511Controller');
    $api->controller('rpt0512', 'Admin\Rpt0512Controller');
    $api->controller('rpt0513', 'Admin\Rpt0513Controller');
    $api->controller('rpt0514', 'Admin\Rpt0514Controller');
    $api->controller('rpt0515', 'Admin\Rpt0515Controller');
    $api->controller('rpt0516', 'Admin\Rpt0516Controller');
    $api->controller('rpt0517', 'Admin\Rpt0517Controller');
    $api->controller('rpt0518', 'Admin\Rpt0518Controller');
    $api->controller('rpt0519', 'Admin\Rpt0519Controller');
    $api->controller('adm0400', 'Admin\Adm0400Controller');
    $api->controller('adm0500', 'Admin\Adm0500Controller');
    $api->controller('adm0110', 'Admin\Adm0110Controller');

    // $api->controller('comments', 'Admin\CommentController');
    $api->get('comments', 'Admin\CommentController@list');

    // TODO: for test
    $api->controller('tmp9999', 'Admin\Tmp9999Controller');
});

$api->group([/*'domain' => $DOMAIN_ADMIN, */'middleware' => ['api', 'api.auth', 'permission:admin.adm0100']], function ($api) {
    $api->controller('users', 'Admin\UserController');
});

// $api->group([/*'domain' => $DOMAIN_CUSTOMER, */'middleware' => ['api', 'api.auth', 'role:customer']], function ($api) {
//     $api->controller('users', 'Customer\UserController');
//     $api->controller('cus0110', 'Customer\Cus0110Controller');
// });

/**
 * For mobile
 */
$apiMobileGroupWareAuth = [];

// if (env('APP_ENV', '') == 'local') {
//     $apiMobileGroupWareAuth = ['middleware' => ['api', 'api.auth']];
// } else {
//     $apiMobileGroupWareAuth = ['domain' => $DOMAIN_ADMIN, 'middleware' => ['api', 'api.auth']];
// }
$apiMobileGroupWareAuth = ['middleware' => ['api', 'api.auth']];

// Non Secure Zone
$api->group(['middleware' => ['api']], function ($api) {
    $api->controller('sp/auth', 'Mobile\AuthController');
});

// Secure zone
$api->group($apiMobileGroupWareAuth, function ($api) {
    // Store
    $api->get('sp/stores', 'Mobile\StoreController@index');
    $api->get('sp/stores/{id}', 'Mobile\StoreController@show')->where('id', '[0-9]+');
    //  - Checkin
    $api->post('sp/stores/{store_id}/checkins', 'Mobile\StoreController@checkin')->where('store_id', '[0-9]+');
    $api->post('sp/stores/{store_id}/checkins/{checkin_id}/images', 'Mobile\StoreController@uploadImage')
        ->where('store_id', '[0-9]+')
        ->where('checkin_id', '[0-9]+');
    //  - Note
    $api->post('sp/stores/{store_id}/notes', 'Mobile\StoreController@note')->where('store_id', '[0-9]+');
    $api->post('sp/stores/{store_id}/notes/{note_id}/images', 'Mobile\StoreController@uploadNoteImage')
        ->where('store_id', '[0-9]+')
        ->where('note_id', '[0-9]+');
    //  - Signature
    $api->get('sp/stores/{store_id}/signature', 'Mobile\StoreController@getSignature')
        ->where('store_id', '[0-9]+');
    $api->post('sp/stores/{store_id}/signature', 'Mobile\StoreController@uploadSignature')
        ->where('store_id', '[0-9]+');

    // Order
    $api->get('sp/orders', 'Mobile\OrderController@index');
    $api->get('sp/orders/views', 'Mobile\OrderController@views');
    $api->get('sp/orders/{order_id}', 'Mobile\OrderController@show')->where('order_id', '[0-9]+');
    $api->get('sp/orders/{order_id}/deliveries', 'Mobile\OrderController@deliveries')->where('order_id', '[0-9]+');

    // Delivery
    $api->get('sp/deliveries', 'Mobile\DeliveryController@index');
    $api->get('sp/deliveries/views', 'Mobile\DeliveryController@views');
    $api->get('sp/deliveries/{delivery_id}', 'Mobile\DeliveryController@show')->where('delivery_id', '[0-9]+');
    $api->post('sp/deliveries/{delivery_id}/signature', 'Mobile\DeliveryController@sign')->where('delivery_id', '[0-9]+');

    // Users
    $api->get('sp/users', 'Mobile\UserController@getListUser');
    $api->get('sp/users/{id}', 'Mobile\UserController@getUser')->where('id', '[0-9]+');
    $api->post('sp/users/checkin', 'Mobile\UserController@postCheckin');
    $api->post('sp/users/checkout', 'Mobile\UserController@postCheckout');

    // Location
    $api->post('sp/locations', 'Mobile\LocationController@store');

    // Area
    $api->get('sp/areas', 'Mobile\AreaController@index');

// Area-Group
    $api->get('sp/area-groups', 'Mobile\AreaGroupController@index');

    // Product
    $api->get('sp/products', 'Mobile\ProductController@index');
    $api->get('sp/products/prices', 'Mobile\ProductController@getPrices');

    // Common
    $api->get('sp/master', 'Mobile\MasterController@index');
    $api->get('sp/setting', 'Mobile\SettingController@index');
});
