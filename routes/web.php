<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::pattern('statename', '[a-z_]+');
Route::pattern('filename', '[%a-zA-Z0-9_-]+');
Route::pattern('id', '\d+');

Route::get('/', 'App\Http\Controllers\IndexController@index')->name('home');
Route::get('/about', 'App\Http\Controllers\IndexController@about');
Route::get('/contact', 'App\Http\Controllers\ContactController@index');
Route::post('/contact', 'App\Http\Controllers\ContactController@index');
Route::get('/search', 'App\Http\Controllers\IndexController@search');
Route::post('/search', 'App\Http\Controllers\IndexController@search_results');
Route::get('/resources', 'App\Http\Controllers\ResourceController@index');
Route::get('/{statename}-adoption', 'App\Http\Controllers\AgencyController@state');
Route::get('/agencies/{filename}_city', 'App\Http\Controllers\AgencyController@city');
Route::get('/agency-{id}.html', 'App\Http\Controllers\AgencyController@view');
Route::get('/agency/comment', 'App\Http\Controllers\AgencyController@comment');
Route::post('/agency/comment', 'App\Http\Controllers\AgencyController@comment');
Route::get('/agency/new', 'App\Http\Controllers\AgencyController@create');
Route::post('/agency/new', 'App\Http\Controllers\AgencyController@create');
Route::get('/agency/update', 'App\Http\Controllers\AgencyController@edit');
Route::post('/agency/update', 'App\Http\Controllers\AgencyController@edit');
Route::get('/send_question', 'App\Http\Controllers\QuestionController@send_question');
Route::post('/send_question', 'App\Http\Controllers\QuestionController@send_question');
Route::get('/send_answer', 'App\Http\Controllers\QuestionController@send_answer');
Route::post('/send_answer', 'App\Http\Controllers\QuestionController@send_answer');

Route::get('/user/new', 'App\Http\Controllers\RegisterController@index');
Route::post('/user/new', 'App\Http\Controllers\RegisterController@index');
Route::get('/user/activate', 'App\Http\Controllers\RegisterController@activate');
Route::get('/user/login', 'App\Http\Controllers\LoginController@login');
Route::post('/user/login', 'App\Http\Controllers\LoginController@login');
Route::get('/user/logout', 'App\Http\Controllers\LoginController@logout');
Route::get('/user/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/user/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/user/pwdreset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');
Route::post('/user/pwdreset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/admin', 'App\Http\Controllers\Admin\IndexController@index')->name('admin');
Route::post('/admin/agency/approve', 'App\Http\Controllers\Admin\AgencyController@approve');
Route::post('/admin/agency/disapprove', 'App\Http\Controllers\Admin\AgencyController@disapprove');
Route::post('/admin/agency/delete', 'App\Http\Controllers\Admin\AgencyController@delete');
Route::get('/admin/agency-log/show/id/{id}', 'App\Http\Controllers\Admin\AgencyLogController@show');
Route::post('/admin/agency-log/approve', 'App\Http\Controllers\Admin\AgencyLogController@approve');
Route::post('/admin/agency-log/disapprove', 'App\Http\Controllers\Admin\AgencyLogController@disapprove');
Route::post('/admin/agency-log/delete', 'App\Http\Controllers\Admin\AgencyLogController@delete');
Route::get('/admin/comment', 'App\Http\Controllers\Admin\CommentController@index')->name('admin.comment');
Route::post('/admin/comment/approve', 'App\Http\Controllers\Admin\CommentController@approve');
Route::post('/admin/comment/disapprove', 'App\Http\Controllers\Admin\CommentController@disapprove');
Route::post('/admin/comment/delete', 'App\Http\Controllers\Admin\CommentController@delete');
Route::get('/admin/question', 'App\Http\Controllers\Admin\QuestionController@index')->name('admin.question');
Route::get('/admin/question_editor', 'App\Http\Controllers\Admin\QuestionController@question_editor');
Route::post('/admin/question_update', 'App\Http\Controllers\Admin\QuestionController@question_update');
Route::get('/admin/answer_editor', 'App\Http\Controllers\Admin\QuestionController@answer_editor');
Route::post('/admin/answer_update', 'App\Http\Controllers\Admin\QuestionController@answer_update');
Route::post('/admin/question/approve', 'App\Http\Controllers\Admin\QuestionController@approve_question');
Route::post('/admin/question/disapprove', 'App\Http\Controllers\Admin\QuestionController@disapprove_question');
Route::post('/admin/question/delete', 'App\Http\Controllers\Admin\QuestionController@delete_question');
Route::post('/admin/answer/approve', 'App\Http\Controllers\Admin\QuestionController@approve_answer');
Route::post('/admin/answer/disapprove', 'App\Http\Controllers\Admin\QuestionController@disapprove_answer');
Route::post('/admin/answer/delete', 'App\Http\Controllers\Admin\QuestionController@delete_answer');

Route::get('/admin/visitor_counts', 'App\Http\Controllers\Admin\VisitorController@visitor_counts');
Route::get('/admin/visitor_delete', 'App\Http\Controllers\Admin\VisitorController@delete_visitor');
Route::get('/admin/agency/search', 'App\Http\Controllers\Admin\AgencyController@search');
Route::post('/admin/agency/search', 'App\Http\Controllers\Admin\AgencyController@search');
Route::get('/admin/agency/edit', 'App\Http\Controllers\Admin\AgencyController@edit');
Route::post('/admin/agency/edit', 'App\Http\Controllers\Admin\AgencyController@edit');