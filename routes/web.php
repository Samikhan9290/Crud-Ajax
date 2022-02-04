<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PostController;
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
Route::get('student',[StudentController::class,'index']);
Route::post('student',[StudentController::class,'store']);
Route::get('fetchStudent',[StudentController::class,'show']);
Route::get('edit_student/{id}',[StudentController::class,'edit']);
Route::put('update_student/{id}',[StudentController::class,'update']);
Route::delete('delete_student/{id}',[StudentController::class,'delete_student']);


Route::get('/post',[PostController::class,'index']);
Route::post('/AddPost',[PostController::class,'store']);
Route::get('/fetchData',[PostController::class,'show']);
Route::get('/edit-post/{id}',[PostController::class,'edit']);
Route::put('/updatePost/{id}',[PostController::class,'update']);
Route::delete('/deletePost/{id}',[PostController::class,'destroy']);
