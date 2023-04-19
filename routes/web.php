<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\QuotesController;
use App\Http\Controllers\Admin\UsersController;
use GuzzleHttp\Middleware;
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

Route::get('/admin/login', [AuthController::class, 'login'])->middleware('guest')->name('admin.login');
Route::post('/admin/signin', [AuthController::class, 'LoginDashboard'])->name('admin.signin');
Route::post('/admin/signin', [AuthController::class, 'LoginDashboard'])->name('admin.signin');


Route::middleware(['auth', 'is_user'])->group(function () {
  Route::get('/editor/dashboard', [HomeController::class, 'editor'])->name('editor.dashboard');
  Route::post('/editor/logout', [AuthController::class, 'logout'])->name('editor.logout');
});



Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {

  //dashboard
  Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

  //categories
  Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
  Route::post('/categories/add', [CategoriesController::class, 'add'])->name('categories.add');
  Route::get('/categories/update/{id}', [CategoriesController::class, 'show'])->name('categories.show');
  Route::post('/categories/update', [CategoriesController::class, 'update'])->name('categories.update');
  Route::delete('/categories/delete/{id}', [CategoriesController::class, 'delete'])->name('categories.delete');
  //quotes
  Route::get('/quotes', [QuotesController::class, 'index'])->name('quotes.index');
  Route::get('/quotes/add', [QuotesController::class, 'add'])->name('quotes.add');
  Route::post('/quotes/addto', [QuotesController::class, 'addto'])->name('quotes.addto');
  Route::get('/quotes/update/{id}/{categ_id}', [QuotesController::class, 'show'])->name('quotes.show');
  Route::post('/quotes/update', [QuotesController::class, 'update'])->name('quotes.update');
  Route::delete('/quotes/delete/{id}', [QuotesController::class, 'delete'])->name('quotes.delete');

  //users
  Route::get('/users', [UsersController::class, 'index'])->name('users.index');
  Route::get('/users/add', [UsersController::class, 'add'])->name('users.add');
  Route::post('/users/add', [UsersController::class, 'store'])->name('users.store');
  Route::get('/users/update/{id}', [UsersController::class, 'show'])->name('users.show');
  Route::post('/users/update/', [UsersController::class, 'update'])->name('users.update');
  Route::delete('/users/delete/{id}', [UsersController::class, 'delete'])->name('users.delete');

  //user profile
  Route::get('/users/profile', [UsersController::class, 'showProfile'])->name('users.profile');
  Route::post('/users/profile', [UsersController::class, 'updateProfile'])->name('profile.update');
  //logout
  Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
