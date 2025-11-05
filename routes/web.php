<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\AIAssistantController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SettingsController;
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

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'sendLoginLink'])->name('auth.send-login-link');
    
    // Register Routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');
    
    // Magic Link Authentication
    Route::get('/login/{token}', [AuthController::class, 'authenticate'])->name('auth.authenticate');
});

// Invalid Token Route (Public)
Route::get('/invalid-token', [AuthController::class, 'invalidToken'])->name('auth.invalid-token');

// Logout Route (Accessible to both authenticated and guest users)
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Protected Routes (Require Authentication)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Companies Management
    Route::prefix('companies')->name('companies.')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        Route::get('/create', [CompanyController::class, 'create'])->name('create');
        Route::post('/', [CompanyController::class, 'store'])->name('store');
        Route::get('/{company}', [CompanyController::class, 'show'])->name('show');
        Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('edit');
        Route::put('/{company}', [CompanyController::class, 'update'])->name('update');
        Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('destroy');
        Route::get('/get/{company}', [CompanyController::class, 'get'])->name('get');
    });
    
    // Job Postings Management
    Route::prefix('job-postings')->name('job-postings.')->group(function () {
        Route::get('/', [JobPostingController::class, 'index'])->name('index');
        Route::get('/create', [JobPostingController::class, 'create'])->name('create');
        Route::post('/', [JobPostingController::class, 'store'])->name('store');
        Route::get('/{jobPosting}', [JobPostingController::class, 'show'])->name('show');
        Route::get('/{jobPosting}/edit', [JobPostingController::class, 'edit'])->name('edit');
        Route::put('/{jobPosting}', [JobPostingController::class, 'update'])->name('update');
        Route::delete('/{jobPosting}', [JobPostingController::class, 'destroy'])->name('destroy');
        Route::post('/{jobPosting}/publish', [JobPostingController::class, 'publish'])->name('publish');
        Route::post('/{jobPosting}/unpublish', [JobPostingController::class, 'unpublish'])->name('unpublish');
    });
    
    // Candidates Management
    Route::prefix('candidates')->name('candidates.')->group(function () {
        Route::get('/', [CandidateController::class, 'index'])->name('index');
        Route::get('/create', [CandidateController::class, 'create'])->name('create');
        Route::post('/', [CandidateController::class, 'store'])->name('store');
        Route::get('/{candidate}', [CandidateController::class, 'show'])->name('show');
        Route::get('/{candidate}/edit', [CandidateController::class, 'edit'])->name('edit');
        Route::put('/{candidate}', [CandidateController::class, 'update'])->name('update');
        Route::delete('/{candidate}', [CandidateController::class, 'destroy'])->name('destroy');
    });
    
    // AI Assistant
    Route::prefix('ai-assistant')->name('ai-assistant.')->group(function () {
        Route::get('/', [AIAssistantController::class, 'index'])->name('index');
        Route::post('/generate-description', [AIAssistantController::class, 'generateDescription'])->name('generate-description');
        Route::post('/optimize-posting', [AIAssistantController::class, 'optimizePosting'])->name('optimize-posting');
        Route::post('/suggest-improvements', [AIAssistantController::class, 'suggestImprovements'])->name('suggest-improvements');
    });
    
    // Analytics
    Route::prefix('analytics')->name('analytics.')->group(function () {
        Route::get('/', [AnalyticsController::class, 'index'])->name('index');
        Route::get('/performance', [AnalyticsController::class, 'performance'])->name('performance');
        Route::get('/candidates', [AnalyticsController::class, 'candidates'])->name('candidates');
        Route::get('/jobs', [AnalyticsController::class, 'jobs'])->name('jobs');
    });
    
    // Templates Management
    Route::prefix('templates')->name('templates.')->group(function () {
        Route::get('/', [TemplateController::class, 'index'])->name('index');
        Route::get('/create', [TemplateController::class, 'create'])->name('create');
        Route::post('/', [TemplateController::class, 'store'])->name('store');
        Route::get('/{template}', [TemplateController::class, 'show'])->name('show');
        Route::get('/{template}/edit', [TemplateController::class, 'edit'])->name('edit');
        Route::put('/{template}', [TemplateController::class, 'update'])->name('update');
        Route::delete('/{template}', [TemplateController::class, 'destroy'])->name('destroy');
        Route::post('/{template}/duplicate', [TemplateController::class, 'duplicate'])->name('duplicate');
    });
    
    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::put('/profile', [SettingsController::class, 'updateProfile'])->name('update-profile');
        Route::put('/security', [SettingsController::class, 'updateSecurity'])->name('update-security');
        Route::put('/preferences', [SettingsController::class, 'updatePreferences'])->name('update-preferences');
        Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('update-notifications');
    });

    // In routes/web.php a guide for roles/permissions
    // Route::middleware(['auth', 'role:super_admin'])->group(function () {
    //     Route::get('/admin/dashboard', 'AdminController@dashboard');
    // });

    // Route::middleware(['auth', 'role:employer'])->group(function () {
    //     Route::get('/employer/dashboard', 'EmployerController@dashboard');
    // });

    // Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    //     Route::get('/job-seeker/dashboard', 'JobSeekerController@dashboard');
    // });

    // public function createJob()
    // {
    //     $this->authorize('create jobs');
    //     // Create job logic
    // }
});

// Fallback Route (404)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});