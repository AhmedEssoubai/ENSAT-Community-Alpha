<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Classes
Route::get('/classes', 'ClassController@index')->name('classes.index');
//Route::get('/classes/create', 'ClassController@create')->name('classes.create');
Route::get('/classes/{class}/members', 'ClassController@members')->name('classes.members');
Route::post('/classes', 'ClassController@store')->name('classes');
// Professors
Route::get('/search/professors/{value}', 'ProfessorController@search')->name('search.professors');
Route::post('/members', 'ClassController@add_professors')->name('add.professors');
Route::get('/professors', 'ProfessorController@index')->name('professors');
// Students
Route::get('/search/students/{value}', 'StudentController@search')->name('search.students');
// Discussions
Route::get('/classes/{class}/discussions', 'DiscussionController@index')->name('classes.discussions.index');
Route::post('/discussions', 'DiscussionController@store')->name('discussions');
Route::get('/discussions/{discussion}/favorite', 'DiscussionController@favorite')->name('discussions.favorite');
Route::get('/discussions/{discussion}/bookmark', 'DiscussionController@bookmark')->name('discussions.bookmark');
Route::get('/discussions/{discussion}', 'DiscussionController@show')->name('discussions.show');
Route::get('/discussions/{discussion}/edit', 'DiscussionController@edit')->name('discussions.edit');
Route::patch('/discussions/{discussion}', 'DiscussionController@update')->name('discussions.update');
Route::get('/discussions/d/{discussion}', 'DiscussionController@destroy')->name('discussions.destroy');
// Resources
Route::get('/classes/{class}/resources', 'ResourceController@index')->name('classes.resources.index');
Route::post('/resources', 'ResourceController@store')->name('resources');
Route::get('/resources/{resource}', 'ResourceController@show')->name('resources.show');
Route::get('/resources/{resource}/edit', 'ResourceController@edit')->name('resources.edit');
Route::patch('/resources/{resource}', 'ResourceController@update')->name('resources.update');
Route::get('/resources/d/{resource}', 'ResourceController@destroy')->name('resources.destroy');
// Assignments
Route::get('/classes/{class}/assignments', 'AssignmentController@index')->name('classes.assignments.index');
Route::post('/assignments', 'AssignmentController@store')->name('assignments');
Route::get('/assignments/{assignment}', 'AssignmentController@show')->name('assignments.show');
Route::get('/assignments/{assignment}/edit', 'AssignmentController@edit')->name('assignments.edit');
Route::patch('/assignments/{assignment}', 'AssignmentController@update')->name('assignments.update');
Route::get('/assignments/d/{assignment}', 'AssignmentController@destroy')->name('assignments.destroy');
// Submissions
Route::post('/submission', 'SubmissionController@store')->name('submissions');
// Files
Route::get('/files/r/{file}', 'FileController@resource')->name('files.resource');
Route::get('/files/a/{file}', 'FileController@assignment')->name('files.assignment');
// Courses
Route::get('/classes/{class}/courses', 'CourseController@index')->name('classes.courses.index');
Route::post('/classes/courses', 'CourseController@store')->name('classes.courses.store');
// Groups
Route::get('/classes/{class}/groups', 'GroupController@index')->name('classes.groups.index');
Route::post('/classes/groups', 'GroupController@store')->name('classes.groups');
//Comment
Route::get('/comments', 'CommentsController@create')->name('comments.create');
Route::get('/comments/{comment}/update', 'CommentsController@update')->name('comments.update');
Route::get('/comments/d/{comment}', 'CommentsController@destroy')->name('comments.destroy');
//Bookmark
Route::get('/bookmarks/{user}', 'BookmarksController@show')->name('bookmarks.show');