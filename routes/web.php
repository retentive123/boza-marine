<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/leadership', [PageController::class, 'leadership'])->name('leadership');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{newsPost}', [NewsController::class, 'show'])->name('news.show');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/careers', [JobController::class, 'index'])->name('careers.index');
Route::get('/careers/apply', [JobApplicationController::class, 'create'])->name('careers.apply');
Route::post('/careers/apply', [JobApplicationController::class, 'store'])->name('careers.apply.store');
Route::get('/careers/{jobPosting}', [JobController::class, 'show'])->name('careers.show');

Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::redirect('/dashboard', '/admin', 302)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
