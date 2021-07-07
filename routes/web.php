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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//save questions
Route::post('/saveQuestions','QuestionsController@saveQuestions');
Route::get('/viewQuestion/{id}','QuestionsController@viewQuestion')->name('viewQuestion');
Route::post('/saveAnswers/{id}','QuestionsController@saveAnswers');
Route::post('/saveComments/{id}/{questionId}','QuestionsController@saveComments');
Route::get('/savevotes/{answerid}/{votes}','QuestionsController@savevotes');
Route::get('/deleteAnswer/{answerid}','QuestionsController@deleteAnswer');
Route::get('/deleteQuestion/{id}','QuestionsController@deleteQuestion');

