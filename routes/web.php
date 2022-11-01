<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectsTasksController;
use Illuminate\Support\Facades\Auth;
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
Route::group(['middleware' => 'auth'], function () {

    Route::get('/projects', [ProjectsController::class, 'index']);
    Route::get('/projects/create', [ProjectsController::class, 'create']);
    Route::get('/projects/{project}', [ProjectsController::class, 'show'])->name('show.projects');
    Route::post('projects', [ProjectsController::class, 'store']);

    Route::post('/projects/{project}/tasks', [ProjectsTasksController::class, 'store'])->name('store.projectTask');
    Route::put('/projects/{project}/tasks/{task}', [ProjectsTasksController::class, 'update'])->name('update.projectTask');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
