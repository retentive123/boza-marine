<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DifferentiatorController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\HeroBackgroundImageController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\HomeHighlightController;
use App\Http\Controllers\Admin\HomeShowcaseImageController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\JobPostingController;
use App\Http\Controllers\Admin\NewsPostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('services', ServiceController::class)->except('show');
    Route::resource('jobs', JobPostingController::class)->except('show')->parameters(['jobs' => 'job']);
    Route::resource('testimonials', TestimonialController::class)->except('show');
    Route::resource('differentiators', DifferentiatorController::class)->except('show');
    Route::resource('clients', ClientController::class)->except('show');
    Route::resource('stats', StatController::class)->except('show');
    Route::resource('hero-slides', HeroSlideController::class)->except('show');
    Route::resource('hero-background', HeroBackgroundImageController::class)->except('show')->parameters(['hero-background' => 'heroBackground']);
    Route::resource('gallery', GalleryImageController::class)->except('show')->parameters(['gallery' => 'galleryImage']);
    Route::resource('news', NewsPostController::class)->except('show')->parameters(['news' => 'newsPost']);
    Route::resource('team', TeamMemberController::class)->except('show')->parameters(['team' => 'teamMember']);
    Route::resource('home-highlights', HomeHighlightController::class)->except('show');
    Route::resource('home-showcase', HomeShowcaseImageController::class)->except('show')->parameters(['home-showcase' => 'homeShowcase']);

    Route::get('applications', [JobApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [JobApplicationController::class, 'show'])->name('applications.show');
    Route::patch('applications/{application}', [JobApplicationController::class, 'update'])->name('applications.update');
    Route::delete('applications/{application}', [JobApplicationController::class, 'destroy'])->name('applications.destroy');

    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');

    Route::resource('users', UserController::class)->except('show');
});
