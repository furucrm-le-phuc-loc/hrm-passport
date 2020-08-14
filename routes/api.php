<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\User;
// use Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('client')->get('/client/user', function (Request $request) {
    return User::all();
});

Route::middleware('auth:api')->get('/apikey/user', function (Request $request) {
    return User::all();
});

Route::middleware('client')->get('/password/user', function (Request $request) {
    return User::all();
});

Route::group([
    'prefix' => 'auth',
    'namespace' => 'Api'
],
function() {
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('/user', 'Auth\LoginController@getUser')->middleware('auth:api');
});


Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function() {
    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'scope:role-admin',
    ],
    function () {
        // amdin user
        Route::apiResource('user', 'UserController');

        // amdin project
        Route::group([
            'prefix' => 'project'
        ],
        function () {
            Route::get('/assigned/{id}', 'ProjectController@assigned')->name('admin.project.assigned');
            Route::delete('/assigned/{id}', 'ProjectController@deleteAssigned')->name('admin.project.deleteAssigned');

            Route::get('/assign/{id}', 'ProjectController@assign')->name('admin.project.assign');
            Route::post('/assign/{id}', 'ProjectController@assignPost')->name('admin.project.assign_post');

            Route::get('/manager', 'ProjectController@getManager');
        });
        Route::apiResource('project', 'ProjectController');

        // amdin absent
        Route::group([
            'prefix' => 'absent'
        ],
        function () {
            Route::get('/', 'AbsentController@index')->name('admin.absent.index');

            Route::get('/approve/{id}', 'AbsentController@approve')->name('admin.absent.approve');
            Route::post('/reject/{id}', 'AbsentController@reject')->name('admin.absent.reject');

        });

        // amdin report
        Route::group([
            'prefix' => 'report'
        ],
        function () {
            Route::get('/', 'ReportController@index')->name('admin.report.index');
        });
    });

    // Manager
    Route::group([
        'prefix' => 'manager',
        'namespace' => 'Manager',
        'middleware' => 'scope:role-manager',
    ],
    function () {
        Route::apiResource('user', 'UserController')->only('index');

        Route::apiResource('project', 'ProjectController');

        Route::group(['prefix' => 'report'], function () {
            Route::get('/', 'ReportController@index')->name('manager.report.index');

            Route::get('/info/{id}', 'ReportController@show')->name('manager.report.info');

            Route::get('/approve/{id}', 'ReportController@approve')->name('manager.report.approve');
            Route::post('/reject/{id}', 'ReportController@reject')->name('manager.report.reject');
        });

        Route::apiResource('absent', 'AbsentController');
        Route::group(['prefix' => 'absent'], function () {
            Route::get('/approve/{id}', 'AbsentController@approve')->name('manager.absent.approve');
            Route::post('/reject/{id}', 'AbsentController@reject')->name('manager.absent.reject');
        });



    });

    //Worker
    Route::group([
        'prefix' => 'worker',
        'namespace' => 'Worker',
        'middleware' => 'scope:role-worker',
    ],
    function () {
        Route::apiResource('absent', 'AbsentController');

        Route::apiResource('project', 'ProjectController')->only('index');


        Route::group(['prefix' => 'report'], function () {
            Route::post('/checkin/{id}', 'ReportController@checkin')->name('manager.absent.approve');
            Route::post('/checkout/{id}', 'ReportController@checkout')->name('manager.absent.reject');
            Route::post('/sendOrDraw/{id}', 'ReportController@sendOrDraw');
        });
        Route::apiResource('report', 'ReportController');


    });
});
