<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\PublicFileController;
use App\Http\Controllers\auth\AuthenticationUserController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\ExtrakulikulerController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\GalleriesController;

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');


Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

Route::get('/galleries', [GalleriesController::class, 'index'])->name('galleries.index');
Route::get('/galleries/{id}', [GalleriesController::class, 'show'])->name('galleries.show');

// Public profile show route used by landing page 'Selengkapnya' links
Route::get('/profiles/{id}', [App\Http\Controllers\PublicProfileController::class, 'show'])->name('profiles.show');

Route::get('/adminkrituga', function () {
    return redirect()->route('login');
});

Route::get('/adminkrituga/login', [AuthenticationUserController::class, 'login'])->name('login');
Route::post('/adminkrituga/login', [AuthenticationUserController::class, 'authenticate'])->name('authenticate');
Route::post('/adminkrituga/logout', [AuthenticationUserController::class, 'logout'])->name('logout');

// Temporary placeholder for register route to avoid "Route [register] not defined" errors
// If registration is not supported, this redirects users to the login page.
Route::get('/register', function () {
    return redirect()->route('login');
})->name('register');

Route::get('/adminkrituga/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->prefix('adminkrituga')->name('admin.')->group(function () {
    // legacy generic upload endpoint (calls UploadController::upload)
    Route::post('/upload-image', [UploadController::class, 'upload'])->name('upload.image');
    // news-specific upload endpoint used by the editor
    Route::post('news/upload-image', [NewsAdminController::class, 'uploadImage'])->name('news.upload.image');
    Route::resource('news', NewsAdminController::class);
    // Backwards-compatible route name expected by some controller redirects and views
    // Controller and views reference `admin.news_admin.*` route names, so provide an alias.
    Route::get('news', [NewsAdminController::class, 'index'])->name('news_admin.index');
    // Also ensure the standard `admin.news.index` name exists for views that reference it.
    Route::get('news', [NewsAdminController::class, 'index'])->name('news.index');
    // Approval endpoint for news (only accessible to superadmin in controller)
    Route::post('news/{id}/approve', [NewsAdminController::class, 'approve'])->name('news.approve');
    Route::resource('extrakulikuler', ExtrakulikulerController::class);
    Route::resource('mitra', MitraController::class);
    // Approval endpoint for ekstrakulikuler (only accessible to superadmin in controller)
    Route::post('extrakulikuler/{id}/approve', [ExtrakulikulerController::class, 'approve'])->name('extrakulikuler.approve');
    // Mitra (partner) resource for admin CRUD
    Route::resource('mitra', MitraController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('visionmissions', VisionMissionController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class);
    // Admin management for expertise descriptions
   // Route upload image HARUS di atas route {id}
Route::post('expertise/upload/image', [App\Http\Controllers\Admin\ExpertiseController::class, 'uploadImage'])->name('expertise.upload.image');

// Route CRUD
Route::get('expertise', [App\Http\Controllers\Admin\ExpertiseController::class, 'index'])->name('expertise.index');
Route::get('expertise/create', [App\Http\Controllers\Admin\ExpertiseController::class, 'create'])->name('expertise.create');
Route::post('expertise', [App\Http\Controllers\Admin\ExpertiseController::class, 'store'])->name('expertise.store');
Route::get('expertise/{id}', [App\Http\Controllers\Admin\ExpertiseController::class, 'show'])->name('expertise.show');
Route::get('expertise/{id}/edit', [App\Http\Controllers\Admin\ExpertiseController::class, 'edit'])->name('expertise.edit');
Route::put('expertise/{id}', [App\Http\Controllers\Admin\ExpertiseController::class, 'update'])->name('expertise.update');
Route::delete('expertise/{id}', [App\Http\Controllers\Admin\ExpertiseController::class, 'destroy'])->name('expertise.destroy');
});

// Public route to show program description
Route::get('/program/{slug}', [ExpertiseController::class, 'show'])->name('expertise.show');

// Publicly serve storage files when symlink is not available.
// This maps /files/{path} -> storage/app/public/{path}
Route::get('/files/{path}', [PublicFileController::class, 'serveFromStorage'])
    ->where('path', '.*')
    ->name('public.files');
