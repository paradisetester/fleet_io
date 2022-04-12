<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# Authentication
#$router->get('/', '\App\Http\Controllers\Api\V1\DefaultController@index');
Route::post('login', '\App\Http\Controllers\Api\V1\AuthController@login' );
Route::post('login/verifyEmail', '\App\Http\Controllers\Api\V1\AuthController@verifyLoginEmail' );
Route::post('login/refresh', '\App\Http\Controllers\Api\V1\AuthController@refresh');
Route::post('registerRequest', '\App\Http\Controllers\Api\V1\RegisterController@registerRequest');
Route::post('registerComplete', '\App\Http\Controllers\Api\V1\RegisterController@registerComplete');
Route::post('completeSiteDetails', '\App\Http\Controllers\Api\V1\RegisterController@completeSiteDetails');
Route::post('subscribe/plan', '\App\Http\Controllers\Api\V1\RegisterController@completeSitePayment');
Route::post('resetpassword', '\App\Http\Controllers\Api\V1\AuthController@Resetpassword' );
Route::post('forgotpasswordupdate', '\App\Http\Controllers\Api\V1\AuthController@forgotpasswordupdate' );
Route::post('verifyotp', '\App\Http\Controllers\Api\V1\AuthController@Optverify');
Route::post('vehicleInspection/uploadFile', '\App\Http\Controllers\Api\V1\InspectionController@uploadFile');
	
Route::group(['middleware' => 'auth:api'], function($router) {
    $router->post('/verifyvehiclemake', '\App\Http\Controllers\Api\V1\MasterEntry\MakeController@verifyMake' );
	$router->post('/verifyvehiclemodel', '\App\Http\Controllers\Api\V1\MasterEntry\ModelController@verifyModel' );
	$router->post('/verifyvehicletype', '\App\Http\Controllers\Api\V1\MasterEntry\TypeController@verifyType' );
	$router->post('logout', '\App\Http\Controllers\Api\V1\AuthController@logout');
	$router->post('profile/update', '\App\Http\Controllers\Api\V1\ProfileController@loginUserUpdate');
	$router->resource('inspectiontemplates', '\App\Http\Controllers\Api\V1\InspectionTemplatesController');
	$router->post('inspectiontemplate/update/{id?}', '\App\Http\Controllers\Api\V1\InspectionTemplatesController@update');
	$router->resource('inspectiontemplatesitem', '\App\Http\Controllers\Api\V1\InspectionTemplateItemsController');
	$router->resource('vehicledetails', '\App\Http\Controllers\Api\V1\VehcileDetailController');
	$router->resource('vehicleInspection', '\App\Http\Controllers\Api\V1\InspectionController');

	$router->post('vehicledetailsUpdate/{id}', '\App\Http\Controllers\Api\V1\VehcileDetailController@update')->name('vehicledetailsUpdate');
		
		
	$router->resource('vehiclelifecycle', '\App\Http\Controllers\Api\V1\VehicleLifeCycleController');
	$router->resource('vehiclespecifications', '\App\Http\Controllers\Api\V1\VehicleSpecificationController');
	$router->resource('vehicleSettings', '\App\Http\Controllers\Api\V1\VehicleSettingController');
	$router->resource('vehicleAssignment', '\App\Http\Controllers\Api\V1\vehicleAssignmentController');
	$router->resource('vehiclemake', '\App\Http\Controllers\Api\V1\MasterEntry\MakeController');
	$router->resource('vehiclemodel', '\App\Http\Controllers\Api\V1\MasterEntry\ModelController');
	$router->resource('service_reminder', '\App\Http\Controllers\Api\V1\ServiceRemindersController');
	$router->resource('vehicle_renewal_reminder', '\App\Http\Controllers\Api\V1\VehicleRenewalRemindersController');
	$router->resource('contact_renewal_reminder', '\App\Http\Controllers\Api\V1\ContactRenewalReminderController');
	$router->get('vehiclemodel_by_make/{makeid?}', '\App\Http\Controllers\Api\V1\MasterEntry\ModelController@vehicleModelByMake');

	$router->get('vehicletype_by_model/{modelid?}', '\App\Http\Controllers\Api\V1\MasterEntry\TypeController@vehicleTypeByModel');

	$router->resource('vehicletype', '\App\Http\Controllers\Api\V1\MasterEntry\TypeController');

	$router->resource('servicehistory', '\App\Http\Controllers\Api\V1\Service\ServiceHistoryController');
	$router->post('servicehistory/update/{id?}', '\App\Http\Controllers\Api\V1\Service\ServiceHistoryController@update');
	$router->resource('fuel', '\App\Http\Controllers\Api\V1\FuelController');
	$router->resource('vehicleexpensehistory', '\App\Http\Controllers\Api\V1\VehicleExpenseHistoryController');
	$router->resource('vehiclemeterhistory', '\App\Http\Controllers\Api\V1\VehicleMeterHistoryController');
	$router->resource('vendor', '\App\Http\Controllers\Api\V1\VendorController');
	$router->resource('issue', '\App\Http\Controllers\Api\V1\IssueController');
	$router->resource('serviceprogram', '\App\Http\Controllers\Api\V1\Service\ServiceProgramController');
	$router->resource('servicetask', '\App\Http\Controllers\Api\V1\Service\ServiceTaskController');
	$router->resource('users', '\App\Http\Controllers\Api\V1\UserController');
	
	$router->resource('permission', '\App\Http\Controllers\Api\V1\PermissionController');

	// FOR FLEET ADMIN ONLY
	$router->resource('orders', '\App\Http\Controllers\Api\V1\PaymentController');
	$router->resource('posts', '\App\Http\Controllers\Api\V1\PostController');
	$router->post('post/update/{post_id?}', '\App\Http\Controllers\Api\V1\PostController@update');
	$router->get('post/delete/{post_id?}', '\App\Http\Controllers\Api\V1\PostController@destroy');
	$router->resource('tenants', '\App\Http\Controllers\Api\V1\TenantController');
	$router->get('dashboard', '\App\Http\Controllers\Api\V1\DashboardController@index');

});

	Route::post('tenants/updates/{post_id?}', '\App\Http\Controllers\Api\V1\TenantController@changeTenantStatus');
Route::get('getPostPage/{slug?}', '\App\Http\Controllers\Api\V1\PostController@getPostPage');
Route::resource('themesetting', '\App\Http\Controllers\Api\V1\ThemeSettingController');
Route::resource('menus', '\App\Http\Controllers\Api\V1\MenuController');
Route::resource('testimonials', '\App\Http\Controllers\Api\V1\TestimonialController');
Route::resource('plans', '\App\Http\Controllers\Api\V1\PlansController');
Route::resource('career', '\App\Http\Controllers\Api\V1\CareerController');
Route::resource('contactus', '\App\Http\Controllers\Api\V1\ContactUsController');

Route::post('check_plan', '\App\Http\Controllers\Api\V1\AuthController@checkTenantPlanExpire' );

Route::get('testing',function(){
    return "nice";
});


Route::get('foo', function (\Illuminate\Http\Request $request) {
    return 'Hello World';
});
