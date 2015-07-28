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

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
Route::get('dashboard', 'DashboardUserController@index');
Route::get('question/create', 'QuestionsController@getCreate');
Route::post('question/create', 'QuestionsController@postCreate');
Route::get('questions/data', 'QuestionsController@data');
Route::get('questions/reorder', 'QuestionsController@getReorder');
Route::get('question/{id}/delete', 'QuestionsController@getDelete');
Route::post('question/{id}/delete', 'QuestionsController@postDelete');


Route::pattern('id', '[0-9]+');
Route::get('question/{id}', 'QuestionsController@show');
Route::get('video/{id}', 'VideoController@show');
Route::get('photo/{id}', 'PhotoController@show');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function() {
    Route::pattern('id', '[0-9]+');
    Route::pattern('id2', '[0-9]+');

    # Admin Dashboard
    Route::get('dashboard', 'DashboardController@index');

    # Country
    Route::get('country', 'CountryController@index');
    Route::get('country/create', 'CountryController@getCreate');
    Route::post('country/create', 'CountryController@postCreate');
    Route::get('country/{id}/edit', 'CountryController@getEdit');
    Route::post('country/{id}/edit', 'CountryController@postEdit');
    Route::get('country/{id}/delete', 'CountryController@getDelete');
    Route::post('country/{id}/delete', 'CountryController@postDelete');
    Route::get('country/data', 'CountryController@data');

    # Question category
    Route::get('questioncategories', 'QuestionCategoriesController@index');
    Route::get('questioncategory/create', 'QuestionCategoriesController@getCreate');
    Route::post('questioncategory/create', 'QuestionCategoriesController@postCreate');
    Route::get('questioncategory/{id}/edit', 'QuestionCategoriesController@getEdit');
    Route::post('questioncategory/{id}/edit', 'QuestionCategoriesController@postEdit');
    Route::get('questioncategory/{id}/delete', 'QuestionCategoriesController@getDelete');
    Route::post('questioncategory/{id}/delete', 'QuestionCategoriesController@postDelete');
    Route::get('questioncategory/data', 'QuestionCategoriesController@data');
    Route::get('questioncategory/reorder', 'QuestionCategoriesController@getReorder');

    # Question
    Route::get('questions', 'QuestionsController@index');
    Route::get('question/create', 'QuestionsController@getCreate');
    Route::post('question/create', 'QuestionsController@postCreate');
    Route::get('question/{id}/edit', 'QuestionsController@getEdit');
    Route::post('question/{id}/edit', 'QuestionsController@postEdit');
    Route::get('question/{id}/reply', 'QuestionsController@getReply');
    Route::post('question/{id}/reply', 'QuestionsController@postReply');
    Route::get('question/{id}/delete', 'QuestionsController@getDelete');
    Route::post('question/{id}/delete', 'QuestionsController@postDelete');
    Route::get('questions/data', 'QuestionsController@data');
    Route::get('question/reorder', 'QuestionsController@getReorder');

    # Users
    Route::get('users/', 'UserController@index');
    Route::get('users/create', 'UserController@getCreate');
    Route::post('users/create', 'UserController@postCreate');
    Route::get('users/{id}/edit', 'UserController@getEdit');
    Route::post('users/{id}/edit', 'UserController@postEdit');
    Route::get('users/{id}/delete', 'UserController@getDelete');
    Route::post('users/{id}/delete', 'UserController@postDelete');
    Route::get('users/data', 'UserController@data');

});
