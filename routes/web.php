<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\DocumentProgressController;
use App\Http\Controllers\DocumentWorkflowController;



// GUP 
Route::get('/', function () {
    return view('pages.home');
})->name('landing');
Route::get('/test403', function () {
    abort(403);
});

Route::get('/gup', [TrackingController::class, 'indexGup'])->name('gup');
Route::get('/gup/search', [TrackingController::class, 'searchGup'])->name('gup.search');

// KKP 
Route::get('/kkp', [TrackingController::class, 'indexKkp'])->name('kkp');
Route::get('/kkp/search', [TrackingController::class, 'searchKkp'])->name('kkp.search');

// SPK 
Route::get('/spk', [TrackingController::class, 'indexSpk'])->name('spk');
Route::get('/spk/search', [TrackingController::class, 'searchSpk'])->name('spk.search');
Route::get('/documents/{id}', [TrackingController::class, 'show'])->name('documents.show');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Document Type
    Route::get('/types', [DocumentTypeController::class, 'index'])->name('types.index');
    Route::get('/types/create', [DocumentTypeController::class, 'create'])->name('types.create');
    Route::post('/types/store', [DocumentTypeController::class, 'store'])->name('types.store');
    Route::get('/types/{type}/edit', [DocumentTypeController::class, 'edit'])->name('types.edit');
    Route::post('/types/{type}/update', [DocumentTypeController::class, 'update'])->name('types.update');
    Route::delete('/types/{type}/delete', [DocumentTypeController::class, 'destroy'])->name('types.destroy');

    // Document
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents/store', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::post('/documents/{document}/update', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('/documents/{document}/delete', [DocumentController::class, 'destroy'])->name('documents.destroy');

    // Workflow
    Route::get('/workflows', [DocumentWorkflowController::class, 'index'])->name('workflows.index');
    Route::get('/workflows/create', [DocumentWorkflowController::class, 'create'])->name('workflows.create');
    Route::post('/workflows/store', [DocumentWorkflowController::class, 'store'])->name('workflows.store');
    Route::get('/workflows/{workflow}/edit', [DocumentWorkflowController::class, 'edit'])->name('workflows.edit');
    Route::post('/workflows/{workflow}/update', [DocumentWorkflowController::class, 'update'])->name('workflows.update');
    Route::delete('/workflows/{workflow}/delete', [DocumentWorkflowController::class, 'destroy'])->name('workflows.destroy');

    // Progress
    Route::get('/progress/{id}', [DocumentProgressController::class, 'show'])
        ->whereNumber('id')->name('progress.show');

    // Update banyak progress dalam 1 dokumen
    Route::post('/progress/{document}/update', [DocumentProgressController::class, 'updateMultiple'])->name('progress.updateMultiple');
    Route::get('/progress', [DocumentProgressController::class, 'index'])->name('progress.index');
    Route::get('/progress/{progress}/edit', [DocumentProgressController::class, 'edit'])->name('progress.edit');
    Route::post('/progress/{progress}/update', [DocumentProgressController::class, 'update'])->name('progress.update');
});
