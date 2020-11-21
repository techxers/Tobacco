<?php

use Illuminate\Support\Facades\Auth;
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


//farmer.add
Route::post('/admin/farmer/add', "AdminController@addFarmer" )->name('farmer.add');

//region
Route::get('/admin/region/view', "AdminController@viewRegion" )->name('admin.region.view');
Route::post('/admin/region/add', "AdminController@addRegion" )->name('admin.region.add');

//tranport
Route::get('/admin/transport/view', "AdminController@viewTransport" )->name('admin.transport.view');
Route::post('/admin/transport/add', "AdminController@addTransport" )->name('admin.transport.add');




Route::get('/pages/user/review/', "RestaurantController@reviewRestaurant" )->name('pages.restaurants.review');
Route::get('/pages/restaurants/', "HomeController@listRestaurants" )->name('pages.restaurants');
Route::get('/pages/restaurants/new', "HomeController@NewRestaurant" )->name('pages.restaurants.new');
//Route::post('/pages/restaurants/register', "Auth\RegisterController@create" )->name('pages.restaurants.register');


//Products and Grade Management


Route::get('/tobacco/manage', "AdminController@manageTobacco" )->name('tobacco.manage');
Route::get('/grades/manage', "AdminController@manageGrades" )->name('grades.manage');
Route::get('/products/manage', "AdminController@manageProducts" )->name('products.manage');
Route::get('/products/grades', "AdminController@manageProductsGrades" )->name('products.grades');
Route::get('/bale/buying', "AdminController@showBuying" )->name('bale.buying');
Route::get('/bale/receiving', "AdminController@showReceiving" )->name('bale.receiving');
Route::post('/bale/create', "AdminController@createBuying" )->name('buying.create');
Route::post('/receving.add', "AdminController@createReceiving" )->name('receving.add');


//
Route::get('/measure/view', "AdminController@viewMeasure" )->name('measure.view');
Route::post('/measure/add', "AdminController@measureAdd" )->name('measure.add');
Route::get('/crop/year/add', "AdminController@cropYear" )->name('crop.year');


Route::get('/customer/view', "AdminController@viewCustomer" )->name('customer.view');
Route::post('/customer/add', "AdminController@addCustomer" )->name('customer.add');
//order
Route::get('/order/view', "AdminController@viewOrder" )->name('order.view');
Route::post('/order/add', "AdminController@addOrder" )->name('order.add');
Route::post('/order/create', "AdminController@createOrder" )->name('order.create');
Route::get('/order/list', "AdminController@viewOrderList" )->name('order.list');



Route::get('/bale/reports', "AdminController@showReports" )->name('bale.reports');




//add
Route::post('/tobacco/add', "AdminController@addTobacco" )->name('tobbaco.add');
Route::post('/product/add', "AdminController@addProduct" )->name('product.add');
Route::post('/grade/add', "AdminController@addGrade" )->name('grade.add');

Route::post('/product/grade/add', "AdminController@addProductGrade" )->name('product.grade.add');

//update
Route::post('/product/update', "AdminController@updateProduct" )->name('Buying.update');




Route::get('/pages/driver/submit', "HomeController@submitDriver" )->name('pages.driver.submit');

Route::get('/pages/restaurants/{restaurant}', "HomeController@restaurantProfile" )->name('pages.restaurants.profile');
Route::get('/pages/restaurants/{restaurant}/menu', "HomeController@viewRestaurantMenu" )->name('pages.restaurants.menu');

Route::get('/portal/dashboard', "PortalController@index" )->name('dashboard');
Route::get('/portal/menu/all', "PortalController@menuList" )->name('menu.list');
Route::patch('/menu/add','MenuController@addMenu')->name('menu.add');


Route::get('/portal/ingredient/all', "PortalController@ingredientList" )->name('ingredients.list');
Route::patch('/ingredient/{restaurant}/add','MenuController@addIngredient')->name('ingredient.add');


Route::get('/portal/generate/qr', "PortalController@qrCodeView" )->name('qr.generate.view');
Route::get('/qr/{restaurant}/response', "RestaurantController@qrCodeResponse" )->name('qr.response');

Route::get('/portal/gallery', "PortalController@gallery" )->name('gallery');
Route::patch('/gallery/{restaurant}/add','RestaurantController@addToGallery')->name('gallery.add');

Route::get('/portal/orders', "PortalController@viewOrders" )->name('orders');
Route::get('/portal/customer/orders', "PortalController@viewCustomerOrders" )->name('customer.orders');


Route::get('/', 'HomeController@index')->name('landing');
Route::get('/search/','HomeController@searchItems')->name('item.search');

Route::get('/menu/{menu}/cart/add','OrderController@cartAdd')->name('cart.add');
Route::post('/restaurant/{restaurant}/cart/complete','OrderController@cartComplete')->name('cart.complete');

Route::get('/restaurant/{restaurant}/order/process', "OrderController@orderStep2")->name('order.step2');
Route::get('/restaurant/{restaurant}/order/finish', "OrderController@orderStep3")->name('order.step3');
Route::post('/order/status/update', "OrderController@updateOrderStatus")->name('order.update');
Route::post('/crop/year/add', "AdminController@cropYeadAdd")->name('cropyear.add');



Route::get('farmer/delete/{farmer_id}', 'AdminController@deleteFarmer');
Route::get('farmer/edit/{farmer_id}', 'AdminController@editFarmer');
Route::get('farmer/search', 'AdminController@searchFarmer')->name('farmer.search');
Route::get('grades/search', 'AdminController@searchGrades')->name('grades.search');
Route::post('grades/update', 'AdminController@updateGrade')->name('grade.update');

Route::get('product/search', 'AdminController@searchProduct')->name('product.search');
Route::post('product/update', 'AdminController@updateProduct')->name('product.update');


Route::get('grade/delete/{grade_id}', 'AdminController@deleteGrade');
Route::get('grade/edit/{params}', 'AdminController@editGrade');

Route::get('product/delete/{poduct_id}', 'AdminController@deleteProduct');
Route::get('product/edit/{params}', 'AdminController@viewEditProduct');
Route::get('transport/delete/{params}', 'AdminController@deleteTransport');



Route::get('tobacoType/delete/{tobacco_id}', 'AdminController@deleteTobacoType');
Route::get('tobacoType/edit/{tobacco_id}', 'AdminController@editTobacoType');


Route::get('crop/year/activate/{crop_id}', 'AdminController@activate');
Route::get('crop/year/deactivate{crop_id}', 'AdminController@deactivate');


Auth::routes([
    'verify' =>true
]);

Route::get('/portal/profile', "PortalController@profile" )->name('profile');
Route::get('/restaurant/tables', "PortalController@viewTables" )->name('restaurant.tables');
// Route::get('/restaurant/profile', "PortalController@kulaPoints" )->name('kula.points');
Route::post('/restaurant/table/add', "PortalController@addTable" )->name('table.add');
Route::post('/restaurant/table/delete', "PortalController@deleteTable" )->name('table.delete');



Route::patch('/portal/profile/update', "RestaurantController@updateProfile" )->name('profile.update');
Route::get('/country/{country}/cities', 'SystemController@getCities')->name('country.cities');



Route::get('/restaurants/details', function () {
    return view('pages.details');
})->name('details');
Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');


Route::get('/order/cart2', function () {
    return view('pages.cart2');
})->name('cart2');
Route::get('/order/cart3', function () {
    return view('pages.cart3');
})->name('cart3');
Route::get('/diet/tips', function () {
    return view('pages.dtips');
})->name('d_tips');


Route::get('/about', function () {
    return view('pages.about');
})->name('about');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::get('/reservation', function () {
    return view('pages.reservation');
})->name('reservation');
Route::get('/tips', function () {
    return view('pages.tips');
})->name('tips');

Route::get('/cart', function () {
    return view('pages.cart');
})->name('cart');


Route::get('/wishes', function () {
    return view('pages.wishes');
})->name('wishes');


Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('checkout');



Route::get('/admin/dashboard', 'AdminController@index')->name('admin.dashboard');
Route::get('/admin/manage/users', 'AdminController@manageUsers')->name('admin.manage.users');
Route::get('/admin/manage/add', 'AdminController@manageAdd')->name('admin.manage.add');

Route::post('/admin/farmer/update', 'AdminController@UpdateStatus')->name('admin.farmer.update');
Route::post('/farmer/update', 'AdminController@UpdateFarmer')->name('farmer.update');

//Excel
Route::get('export', 'ImportExportController@export')->name('export');
Route::get('importExportView', 'ImportExportController@importExportView');
Route::post('import', 'ImportExportController@import')->name('import');

Route::post('import', 'ImportExportController@importGrades')->name('import.grade');

//PDG
Route::get('invoice', 'ImportExportController@generateBuyingInvoice')->name('buying.invoice');

Route::get('/menu', function () {
    return view('pages.menu');
})->name('menu');
Route::get('/menu/all',"HomeController@menuAll")->name('menu.all');
Route::post('/menu/delete',"HomeController@delete")->name('menu.remove');

Route::get('/menu/{category?}',"HomeController@listRestaurants")->name('list-restaurants');
Route::get('/menu/restaurant/{id}',"HomeController@restaurantCategories")->name('list-category');


Route::get('/home', 'HomeController@index')->name('home');


/************ Mobile api Urls *******************/
#Route::post("/api/restaurants","MobileController@getAllRestaurants");
Route::post("/api/restaurant","MobileController@getRestaurants");
Route::post("/api/restaurant/menus","MobileController@getAllMenus");
Route::post("/api/restaurant/menu","MobileController@getMenu");

//Route::post("/api/restaurant/categories","MobileController@getMenuCategories");

Route::post('/api/user/login','MobileController@loginInUser');//e.g. api/user/auth?email=collins@gmail.com&password=collins
Route::post('/api/user/register','MobileController@registerUser');

Route::post("/api/categories/all","MobileController@getCategories");
Route::post("/api/menus/all","MobileController@getMenus");
//Route::post("/api/tips/all","MobileController@getTips");

Route::post("/api/user/reservations","MobileController@getReservations");
Route::post("/api/user/reservation/create","MobileController@newReservation");

Route::post("/api/user/orders","MobileController@getOrders");
Route::post("/api/order/create","MobileController@createOrder");

Route::post("/api/restaurants/all","MobileController@getAllRestaurants");

/*
 *End of Mobile api routes
 */
