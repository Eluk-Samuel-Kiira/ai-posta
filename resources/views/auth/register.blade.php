@extends('auth.layout')

@section('title', 'Register - AI Powered Job Posting')

@section('auth-icon', 'fa-user-plus')

@section('auth-subtitle', 'Create your account to start automating job postings')

@section('auth-content')
<form method="POST" action="{{ route('auth.register.submit') }}">
    @csrf
    
    <input type="hidden" class="form-control" id="role" name="role" value="outsider">
    
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" id="username" name="username" 
                   placeholder="Choose a username" value="{{ old('username') }}" required>
        </div>
        @error('username')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
            <input type="text" class="form-control" id="name" name="name" 
                   placeholder="Enter your full name" value="{{ old('name') }}" required>
        </div>
        @error('name')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" class="form-control" id="email" name="email" 
                   placeholder="Enter your email address" value="{{ old('email') }}" required>
        </div>
        @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="company" class="form-label">Company (Optional)</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-building"></i></span>
            <input type="text" class="form-control" id="company" name="company" 
                   placeholder="Your company name" value="{{ old('company') }}">
        </div>
        @error('company')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
        <label class="form-check-label" for="terms">
            I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
        </label>
        @error('terms')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-auth">
        <i class="fas fa-user-plus"></i> Create Account
    </button>
</form>
@endsection

@section('auth-footer')
<p>Already have an account? <a href="{{ route('auth.login') }}">Login here</a></p>
@endsection