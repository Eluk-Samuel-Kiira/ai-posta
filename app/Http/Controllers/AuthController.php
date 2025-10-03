<?php

namespace App\Http\Controllers;

use App\Models\LoginToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MagicLoginLink;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('info', 'You are already logged in.');
        }
        return view('auth.login');
    }

    // Show registration form
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('info', 'You are already logged in.');
        }
        return view('auth.register');
    }

    // Send magic login link
    public function sendLoginLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255'
        ]);

        $email = $request->email;
        
        // Check if user exists
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'No account found with this email address. Please register first.');
        }

        // Create login token
        $token = Str::random(60);
        $expiresAt = now()->addHours(24); // Token valid for 24 hours

        LoginToken::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        // Send magic link email
        try {
            Mail::to($user->email)->send(new MagicLoginLink($token));
            
            return back()->with('success', 'Magic login link sent to your email! Check your inbox.');
        } catch (\Exception $e) {
            \Log::error('Failed to send magic link: ' . $e->getMessage());
            return back()->with('error', 'Failed to send login link. Please try again.');
        }
    }

    // Authenticate user with magic link
    public function authenticate($token)
    {
        $loginToken = LoginToken::with('user')
            ->where('token', $token)
            ->first();

        if (!$loginToken || !$loginToken->isValid()) {
            return redirect()->route('auth.invalid-token');
        }

        // Log the user in
        Auth::login($loginToken->user);

        // Mark token as used
        $loginToken->markAsUsed();

        // Clear expired tokens
        $this->clearExpiredTokens($loginToken->user->id);

        return redirect()->intended('/dashboard')->with('success', 'Welcome back!');
    }
    
    // User registration
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'company' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|in:outsider,insider',
            'terms' => 'required|accepted',
        ], [
            'terms.required' => 'You must agree to the Terms of Service and Privacy Policy.',
            'terms.accepted' => 'You must agree to the Terms of Service and Privacy Policy.',
            'role.in' => 'Please select a valid account type.',
        ]);

        // Handle profile image upload
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile-images', 'public');
            
            // Get just the filename
            $profileImagePath = basename($profileImagePath);
        }

        // Create user
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'company' => $request->company,
            'profile_image' => $profileImagePath,
            'role' => $request->role,
            'password' => Hash::make(Str::random(32)),
        ]);

        // Create login token
        $token = Str::random(60);
        $expiresAt = now()->addHours(24);

        LoginToken::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        // Send welcome email with magic link
        try {
            Mail::to($user->email)->send(new MagicLoginLink($token, true));
            
            return redirect()->route('auth.login')->with('success', 'Account created successfully! Check your email for the magic login link.');
        } catch (\Exception $e) {
            \Log::error('Failed to send welcome email: ' . $e->getMessage());
            return back()->with('error', 'Account created but failed to send login link. Please try logging in.');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    // Invalid token page
    public function invalidToken()
    {
        return view('auth.invalid-token');
    }

    // Clear expired tokens for a user
    private function clearExpiredTokens($userId)
    {
        LoginToken::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('expires_at', '<', now())
                    ->orWhereNotNull('used_at');
            })
            ->delete();
    }

    
}