<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashBoardController;

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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login-link', [AuthController::class, 'sendLoginLink'])->name('auth.login-link');
Route::get('/login/{token}', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');

// Invalid Token
Route::get('/invalid-token', [AuthController::class, 'invalidToken'])->name('auth.invalid-token');

// routes/web.php - Add this temporary route
Route::get('/test-email', function () {
    try {
        \Log::info('Testing email configuration...');
        
        // Test basic SMTP connection
        $transport = new \Swift_SmtpTransport(
            env('MAIL_HOST'),
            env('MAIL_PORT'),
            env('MAIL_ENCRYPTION')
        );
        $transport->setUsername(env('MAIL_USERNAME'));
        $transport->setPassword(env('MAIL_PASSWORD'));
        
        $mailer = new \Swift_Mailer($transport);
        
        // Test the connection
        $mailer->getTransport()->start();
        \Log::info('SMTP connection successful');
        
        // Test sending an actual email
        Mail::raw('Test email from LaFab Solution', function ($message) {
            $message->to('test@example.com')
                    ->subject('Test Email Configuration');
        });
        
        \Log::info('Test email sent successfully');
        return 'Email configuration is working!';
        
    } catch (\Exception $e) {
        \Log::error('Email test failed: ' . $e->getMessage());
        return 'Email error: ' . $e->getMessage();
    }
});

// Protected Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/job-parser', [DashboardController::class, 'jobParser'])->name('job-parser');
    Route::get('/companies', [DashboardController::class, 'companies'])->name('companies');
    Route::get('/job-postings', [DashboardController::class, 'jobPostings'])->name('job-postings');
    Route::get('/ai-assistant', [DashboardController::class, 'aiAssistant'])->name('ai-assistant');
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    Route::get('/candidates', [DashboardController::class, 'candidates'])->name('candidates');
    Route::get('/templates', [DashboardController::class, 'templates'])->name('templates');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
});