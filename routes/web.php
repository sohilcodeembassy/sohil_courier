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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/email', function () {
    return view('admin.EmailTemplate.welcome');
});

Auth::routes();

//Route::get('/home', 'User\HomeController@index')->name('home');
//Route::get('/users/logout', 'User\Auth\LoginController@userLogout')->name('user.logout');
// Route::get('/usertest', 'User\HomeController@userTest')->name('usertest');
Route::get('/', 'User\HomeController@index')->name('home');
Route::get('/about', 'User\HomeController@about')->name('about');
Route::get('/contact', 'User\HomeController@contact')->name('contact');
Route::get('/services', 'User\HomeController@services')->name('services');
Route::get('/blog', 'User\HomeController@blog')->name('blog');
Route::get('/register', 'User\HomeController@showRegistrationForm')->name('register');
Route::get('/login', 'User\HomeController@login')->name('login');

Route::post('/register_user', 'User\HomeController@RegisterUser')->name('post.register.user');
Route::get('/searchSuburb', 'User\AjaxController@searchSuburb')->name('post.search.suburb');


	Route::prefix('admin')->group(function(){

		//Admin management route
		Route::get('/login', 'Admin\Auth\AdminLoginController@showLoginForm')->name('admin.login');
		Route::post('/login', 'Admin\Auth\AdminLoginController@login')->name('admin.login.submit');
		Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
		Route::get('/logout', 'Admin\Auth\AdminLoginController@logout')->name('admin.logout');
		Route::get('/admintest', 'Admin\AdminController@admintest')->name('admin.admintest');

		Route::post('/password/email','Admin\Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
		Route::get('/password/reset','Admin\Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
		Route::post('/password/reset','Admin\Auth\AdminResetPasswordController@reset');
		Route::get('/password/reset/{token}','Admin\Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

		//User management route
		Route::get('/user', 'Admin\UserController@user')->name('admin.user');
		Route::post('/postuser', 'Admin\UserController@postUser')->name('admin.post.user');
		Route::post('/userstatus', 'Admin\AjaxController@userStatus')->name('admin.user.status');
		Route::post('/userdelete', 'Admin\AjaxController@userDelete')->name('admin.user.delete');
		Route::get('/edituser/{id}', 'Admin\UserController@editUser')->name('admin.edit.user');
		Route::post('/postedituser', 'Admin\UserController@postEditUser')->name('admin.post.edit.user');
		Route::post('/useredelete', 'Admin\AjaxController@userCommunicationEmailDelete')->name('admin.user_c_email.delete');
		
		Route::get('/memberportal/{id}', 'Admin\UserController@memberPortal')->name('admin.user.member.portal');
		Route::post('/postmemberportal', 'Admin\UserController@postMemberPortal')->name('admin.post.member.portal');
		
		Route::get('/pricingportal/{id}', 'Admin\UserController@pricingPortal')->name('admin.user.pricing.portal');
		Route::post('/postpricingportal', 'Admin\UserController@postPricingPortal')->name('admin.post.user.pricing.portal');
		Route::post('/pricingportalapiallstatus', 'Admin\AjaxController@pricingPortalApiAllStatus')->name('admin.user.pricing.portal.api.all_status');
		Route::post('/pricingportalstatus', 'Admin\AjaxController@pricingPortalStatus')->name('admin.user.pricing.portal.status');
		Route::post('/pricingportaldelete', 'Admin\AjaxController@pricingPortalDelete')->name('admin.user.pricing.portal.delete');


		//Blog and Blog category management route
		Route::get('/blogcategory', 'Admin\BlogCategoryController@blogCategory')->name('admin.blog_category');
		Route::post('/postblogcategory', 'Admin\BlogCategoryController@postBlogCategory')->name('admin.post.blog_category');
		Route::post('/blogcategorystatus', 'Admin\AjaxController@blogCategoryStatus')->name('admin.blog_category.status');
		Route::post('/blogcategorydelete', 'Admin\AjaxController@blogCategoryDelete')->name('admin.blog_category.delete');
		Route::get('/editblogcategory/{id}', 'Admin\BlogCategoryController@editBlogCategory')->name('admin.edit.blog_category');
		Route::post('/posteditblogcategory', 'Admin\BlogCategoryController@postEditBlogCategory')->name('admin.post.edit_blog_category');

		//Blog Management route
		Route::get('/blog', 'Admin\BlogController@blog')->name('admin.blog');
		Route::post('/postblog', 'Admin\BlogController@postBlog')->name('admin.post.blog');
		Route::get('/download/{img_name}', 'admin\BlogController@downloadBlogImage')->name('admin.blog.download.img');
		Route::post('/blogstatus', 'Admin\AjaxController@blogStatus')->name('admin.blog.status');
		Route::post('/blogdelete', 'Admin\AjaxController@blogDelete')->name('admin.blog.delete');
		Route::get('/editblog/{id}', 'Admin\BlogController@editBlog')->name('admin.edit.blog');
		Route::post('/posteditblog', 'Admin\BlogController@postEditBlog')->name('admin.post.edit_blog');

		//Api Management route
		Route::get('/api', 'Admin\ApiController@api')->name('admin.api');
		Route::post('/postapi', 'Admin\ApiController@postApi')->name('admin.post.api');
		Route::post('/apistatus', 'Admin\AjaxController@apiStatus')->name('admin.api.status');
		Route::post('/apidelete', 'Admin\AjaxController@apiDelete')->name('admin.api.delete');
		Route::get('/editapi/{id}', 'Admin\ApiController@editApi')->name('admin.edit.api');
		Route::post('/posteditapi', 'Admin\ApiController@postEditApi')->name('admin.post.edit_api');
		Route::post('/apiallstatus', 'Admin\AjaxController@apiAllStatus')->name('admin.api.all_status');

		//Gst & Levy Management
		Route::get('/getlevy', 'Admin\GstLevyController@getlevy')->name('admin.getlevy');
		Route::post('/getlevyedit', 'Admin\AjaxController@getlevyEdit')->name('admin.getlevy.edit');

		//Package Management
		Route::get('/package', 'Admin\PackageController@package')->name('admin.package');
		Route::post('/postpackage', 'Admin\PackageController@postPackage')->name('admin.post.package');
		Route::get('/editpackage/{id}', 'Admin\PackageController@editPackage')->name('admin.edit.package');
		Route::post('/posteditpackage', 'Admin\PackageController@postEditPackage')->name('admin.post.edit.package');
		Route::post('/packagedelete', 'Admin\AjaxController@packageDelete')->name('admin.package.delete');
		Route::post('/deletepackagesize', 'Admin\AjaxController@deletePackageSize')->name('admin.ajax.delete.package.size');
		Route::post('/ajaxgetpackagemeasurement', 'Admin\AjaxController@ajaxGetPackageMeasurement')->name('admin.ajax.get.package.measurement');

		//User Package Management
		Route::get('/userpackage', 'Admin\UserPackageController@userPackage')->name('admin.userpackage');
		Route::post('/userpackageactivedeactie', 'Admin\AjaxController@userPackageActiveDeactive')->name('admin.ajax.active.deactive.userpackage');

		//Holiday Management route
		Route::get('/holiday', 'Admin\HolidayController@holiday')->name('admin.holiday');
		Route::post('/postholiday', 'Admin\HolidayController@postHoliday')->name('admin.post.holiday');
		Route::post('/holidaystatus', 'Admin\AjaxController@holidayStatus')->name('admin.holiday.status');
		Route::post('/holidaydelete', 'Admin\AjaxController@holidayDelete')->name('admin.holiday.delete');
		Route::get('/editholiday/{id}', 'Admin\HolidayController@editHoliday')->name('admin.edit.holiday');




		// Route::get('/editor', 'Editor\EditorController@index')->name('admin.index');
		// Route::get('/test', 'Editor\EditorController@test')->name('admin.editor.test');


		
	});

