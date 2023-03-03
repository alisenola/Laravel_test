<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, IndexController};

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
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name(
        'post.login'
    );  
    Route::get('/register', [AuthController::class, 'viewRegister'])->name(
        'register'
    );
    Route::post('/register', [AuthController::class, 'postRegister'])->name(
        'post.register'
    );
});

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/', [IndexController::class, 'viewHome'])->name('home');
    Route::get('/create/article/{section}/{article?}', [IndexController::class, 'viewCreateArticle'])->name('create-article');
    Route::get('/create/report/{section}/{report?}', [IndexController::class, 'viewCreateReport'])->name('create-report');
    Route::get('/create/book/{section}/{book?}', [IndexController::class, 'viewCreateBook'])->name('create-book');
    Route::get('/del/article/{article}', [IndexController::class, 'delArticle'])->name('delarticle');
    Route::get('/del/report/{report}', [IndexController::class, 'delReport'])->name('delreport');
    Route::get('/del/book/{book}', [IndexController::class, 'delBook'])->name('delbook');
    Route::post('/create/article/{section}/{article?}', [IndexController::class, 'createArticle'])->name('post.createarticle');
    Route::post('/create/report/{section}/{report?}', [IndexController::class, 'createReport'])->name('post.createreport');
    Route::post('/create/book/{section}/{book?}', [IndexController::class, 'createBook'])->name('post.createbook');
    Route::get('/download/pdf/{filename}', [IndexController::class, 'getDownload'])->name('downpdf');
});