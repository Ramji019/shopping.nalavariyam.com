<?php
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/nearby/{lat}/{lng}', [App\Http\Controllers\HomeController::class, 'nearby'])->name('nearby');
Route::get('/product/{id}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/subcategory/{id}', [App\Http\Controllers\HomeController::class, 'subcategory'])->name('subcategory');
Route::get('/thirdcategory/{id}', [App\Http\Controllers\HomeController::class, 'thirdcategory'])->name('thirdcategory');
Route::get('/category/{id}', [App\Http\Controllers\HomeController::class, 'category'])->name('category');
Route::get('/statewise/{id}', [App\Http\Controllers\HomeController::class, 'statewise'])->name('statewise');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about_us', [App\Http\Controllers\HomeController::class, 'about_us'])->name('about_us');
Route::get('/contact_us', [App\Http\Controllers\HomeController::class, 'contactus'])->name('contact_us');
Route::post('/addcontactus', [App\Http\Controllers\HomeController::class, 'addcontactus'])->name('addcontactus');
Route::get('/purchase', [App\Http\Controllers\HomeController::class, 'purchase'])->name('purchase');
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');


Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('/user/bookmark', [App\Http\Controllers\UserController::class, 'bookmark'])->name('bookmark');
Route::get('/user/my_products', [App\Http\Controllers\UserController::class, 'myproducts'])->name('my_products');
Route::get('/user/sold_products', [App\Http\Controllers\UserController::class, 'soldproducts'])->name('sold_products');

Route::get('/user/wishlist', [App\Http\Controllers\UserController::class, 'wishlist'])->name('wishlist');
Route::get('/user/add_product', [App\Http\Controllers\UserController::class, 'addproduct'])->name('add_product');
Route::post('/saveproduct', [App\Http\Controllers\UserController::class, 'saveproduct'])->name('saveproduct');
Route::post('/saveprofile', [App\Http\Controllers\UserController::class, 'saveprofile'])->name('saveprofile');
Route::post('/updateproduct', [App\Http\Controllers\UserController::class, 'updateproduct'])->name('updateproduct');
Route::get('/user/edit_product/{id}', [App\Http\Controllers\UserController::class, 'edit_product'])->name('edit_product');
Route::get('/user/delete_product/{id}', [App\Http\Controllers\UserController::class, 'delete_product'])->name('delete_product');
Route::get('/removeimage/{id}', [App\Http\Controllers\UserController::class, 'removeimage'])->name('removeimage');
Route::get('/user/change_password', [App\Http\Controllers\UserController::class, 'change_password'])->name('change_password');
Route::post('/update_password', [App\Http\Controllers\UserController::class, 'update_password'])->name('update_password');
Route::post('/checkLogin', [App\Http\Controllers\Admin\LoginController::class, 'checkLogin'])->name('checklogin');






Route::get('/buyerregister', [App\Http\Controllers\UserController::class, 'register'])->name('buyerregister');

Route::post('/savebuyerregister', [App\Http\Controllers\UserController::class, 'savebuyerregister'])->name('savebuyerregister');
Route::get('/sellerregister', [App\Http\Controllers\UserController::class, 'SellerRegister'])->name('sellerregister');
Route::post('/savesellerregister', [App\Http\Controllers\UserController::class, 'savesellerregister'])->name('savesellerregister');
Route::post('/sellerLogin', [App\Http\Controllers\Admin\LoginController::class, 'sellerLogin'])->name('sellerLogin');
Route::post('/buyerLogin', [App\Http\Controllers\Admin\LoginController::class, 'buyerLogin'])->name('buyerLogin');
Route::get('/userlogout', [App\Http\Controllers\Admin\LoginController::class, 'userlogout'])->name('userlogout');
ROUTE::post('/buyerregistermobile', [App\Http\Controllers\UserController::class, 'buyerregistermobile'])->name('buyerregistermobile');
ROUTE::post('/changepassword', [App\Http\Controllers\UserController::class, 'changepassword'])->name('changepassword');
Route::get('/forgotpassotp/{mobile}', [App\Http\Controllers\UserController::class, 'forgotpassotp'])->name('forgotpassotp');
ROUTE::get('/user/wish', [App\Http\Controllers\UserController::class, 'wish'])->name('wish');
ROUTE::post('/addwish', [App\Http\Controllers\UserController::class, 'addwish'])->name('addwish');
Route::post('/savecart', [App\Http\Controllers\CartController::class, 'savecart'])->name('savecart');


Auth::routes();

Route::get('/admin', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('admin');
Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admindashboard');
Route::get('admin/plan', [App\Http\Controllers\Admin\PlanController::class, 'ManagePlan'])->name('plan');
ROUTE::post('/addplan', [App\Http\Controllers\Admin\PlanController::class, 'AddPlan'])->name('addplan');
ROUTE::post('/editplan', [App\Http\Controllers\Admin\PlanController::class, 'EditPlan'])->name('editplan');

Route::post('/add_cart', [App\Http\Controllers\CartController::class, 'add_cart'])->name('add_cart');
Route::get('cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::get('/deletecart/{id}', [App\Http\Controllers\CartController::class, 'deletecart'])->name('deletecart');



Route::get('admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
Route::post('/addusers', [App\Http\Controllers\Admin\UserController::class, 'AddUsers'])->name('addusers');
Route::post('/editusers', [App\Http\Controllers\Admin\UserController::class, 'EditUsers'])->name('editusers');
Route::get('/deleteuser/{id}', [App\Http\Controllers\Admin\UserController::class, 'DeleteUsers'])->name('deleteuser');
ROUTE::post('/getplan', [App\Http\Controllers\UserController::class, 'getplan'])->name('getplan');

Route::get('admin/seller', [App\Http\Controllers\Admin\SellerController::class, 'manageSeller'])->name('seller');
ROUTE::post('/addseller', [App\Http\Controllers\Admin\SellerController::class, 'addseller'])->name('addseller');
ROUTE::post('/editseller', [App\Http\Controllers\Admin\SellerController::class, 'editseller'])->name('editseller');
Route::get('/sellerproduct/{seller_id}', [App\Http\Controllers\Admin\SellerController::class, 'ManageSell'])->name('sellerproduct');

Route::get('admin/buyer', [App\Http\Controllers\Admin\BuyerController::class, 'manageBuyer'])->name('buyer');
ROUTE::post('/addbuyer', [App\Http\Controllers\Admin\BuyerController::class, 'AddBuyer'])->name('addbuyer');
ROUTE::post('/editbuyer', [App\Http\Controllers\Admin\BuyerController::class, 'EditBuyer'])->name('editbuyer');

Route::get('admin/products', [App\Http\Controllers\Admin\ProductController::class, 'manageProduct'])->name('products');
Route::get('admin/products/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'Edit'])->name('editproducts');
Route::get('admin/orders', [App\Http\Controllers\Admin\ProductController::class, 'orders'])->name('orders');
Route::get('admin/details/{id}', [App\Http\Controllers\Admin\ProductController::class, 'details'])->name('details');
ROUTE::post('/addproduct', [App\Http\Controllers\Admin\ProductController::class, 'AddProduct'])->name('addproduct');
ROUTE::post('/updateorder', [App\Http\Controllers\Admin\ProductController::class, 'updateorder'])->name('updateorder');
ROUTE::post('/updatestock', [App\Http\Controllers\Admin\ProductController::class, 'updatestock'])->name('updatestock');
ROUTE::post('/editproducts', [App\Http\Controllers\Admin\ProductController::class, 'EditProduct'])->name('editproducts');
Route::get('admin/photos/{id}', [App\Http\Controllers\Admin\ProductController::class, 'photos'])->name('photos');
Route::get('admin/delete/{id}/{product_id}', [App\Http\Controllers\Admin\ProductController::class, 'delete']);

Route::get('admin/category', [App\Http\Controllers\Admin\CategoryController::class, 'manageCategory'])->name('category');
Route::get('admin/attribute', [App\Http\Controllers\Admin\CategoryController::class, 'attribute'])->name('attribute');
Route::get('admin/catattribute', [App\Http\Controllers\Admin\CategoryController::class, 'catattribute'])->name('catattribute');
ROUTE::post('/addattribute', [App\Http\Controllers\Admin\CategoryController::class, 'AddAttribute'])->name('addattribute');
ROUTE::post('/linkattribute', [App\Http\Controllers\Admin\CategoryController::class, 'linkattribute'])->name('linkattribute');
ROUTE::post('/getsubcategory', [App\Http\Controllers\Admin\CategoryController::class, 'getsubcategory'])->name('getsubcategory');
ROUTE::post('/gettaluk', [App\Http\Controllers\Admin\CategoryController::class, 'gettaluk'])->name('gettaluk');
ROUTE::post('/gettalukfront', [App\Http\Controllers\UserController::class, 'gettalukfront'])->name('gettalukfront');
ROUTE::post('/getcity', [App\Http\Controllers\Admin\CategoryController::class, 'getcity'])->name('getcity');
Route::Post('/getattributes', [App\Http\Controllers\Admin\CategoryController::class, 'getattributes'])->name('getattributes');
Route::get('/deleteattribute/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deleteattribute'])->name('deleteattribute');
Route::get('/deleteattributelink/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deleteattributelink'])->name('deleteattributelink');
ROUTE::post('/addcategory', [App\Http\Controllers\Admin\CategoryController::class, 'AddCategory'])->name('addcategory');
ROUTE::post('/addsubcategory', [App\Http\Controllers\Admin\CategoryController::class, 'AddSubCategory'])->name('addsubcategory');
ROUTE::post('/editcategory', [App\Http\Controllers\Admin\CategoryController::class, 'EditCategory'])->name('editcategory');
ROUTE::get('admin/subcategory/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'manageSubcategory'])->name('subcategory');
ROUTE::post('/editsubcategory', [App\Http\Controllers\Admin\CategoryController::class, 'EditSubCategory'])->name('editsubcategory');
Route::get('/deletesubcategory/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'DeleteSubcat'])->name('deletesubcategory');
ROUTE::get('admin/thirdlevelcategory/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'manageThirdcategory'])->name('thirdlevelcategory');
ROUTE::post('/addthirdcategory', [App\Http\Controllers\Admin\CategoryController::class, 'AddThirdCategory'])->name('addthirdcategory');
ROUTE::post('/editthirdcategory', [App\Http\Controllers\Admin\CategoryController::class, 'EditThirdCategory'])->name('editthirdcategory');
Route::get('/deletethirdcategory/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'DeleteThirdCategory'])->name('deletethirdcategory');




Route::get('/users', [App\Http\Controllers\ChatController::class, 'users'])->name('users');
Route::get('/chat/{id}', [App\Http\Controllers\ChatController::class, 'chat'])->name('chat');
Route::post('/productchat', [App\Http\Controllers\ChatController::class, 'productchat'])->name('productchat');
Route::get('/getchat/{id}', [App\Http\Controllers\ChatController::class, 'getchat'])->name('getchat');
Route::get('/addfavorites/{user_id}/{product_id}', [App\Http\Controllers\UserController::class, 'addfavorites'])->name('addfavorites');
Route::get('/removefavorites/{user_id}/{product_id}', [App\Http\Controllers\UserController::class, 'removefavorites'])->name('removefavorites');
Route::get('/markassold/{product_id}', [App\Http\Controllers\UserController::class, 'markassold'])->name('markassold');
Route::get('/marksold/{product_id}', [App\Http\Controllers\UserController::class, 'marksold'])->name('marksold');