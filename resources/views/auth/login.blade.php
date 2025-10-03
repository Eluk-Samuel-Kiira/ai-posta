@extends('auth.layout')

@section('title', 'Login - AI Powered Job Posting')

@section('auth-icon', 'fa-magic')

@section('auth-subtitle', 'Enter your email to receive a magic login link')

@section('auth-content')
<form method="POST" action="{{ route('auth.login-link') }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" class="form-control" id="email" name="email" 
                   placeholder="Enter your email address" required
                   value="{{ old('email') }}">
        </div>
    </div>
    
    <button type="submit" class="btn btn-auth">
        <i class="fas fa-paper-plane"></i> Send Magic Link
    </button>
</form>
@endsection

@section('auth-footer')
<p>Don't have an account? <a href="{{ route('auth.register') }}">Register here</a></p>
@endsection