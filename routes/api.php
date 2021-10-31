<?php
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
 	Route::post('/login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');

    //Users list
    Route::prefix('/jobseeker')->group(function(){
        Route::get('/list','Api\UsersController@list');
    });

    //Search users by name or location
    Route::post('/search/{name}', 'Api\UsersController@filter');

    Route::group(['middleware' => 'auth:api'], function(){

        //User's profile details and profile image upload
        Route::prefix('/profile')->group(function(){
            Route::get('/init','Api\UsersController@profileInit');
            Route::post('/upload','Api\UsersController@profileUpload');
            Route::get('/profileImage','Api\UsersController@profileImage');

            //User's detail update
            Route::post('/update/{id}','Api\UsersController@profileUpdate');
        });

        //Uploading the photo gallery for users
        Route::prefix('/gallery')->group(function(){
            Route::post('/upload', 'Api\UsersController@storeGallery');
        });

        Route::post('/logout','Api\UsersController@logout');
       
 	});
});
