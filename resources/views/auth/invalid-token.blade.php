@extends('auth.layout')

@section('title', 'Invalid Token - AI Powered Job Posting')

@section('auth-icon', 'fa-exclamation-triangle')

@section('auth-subtitle', 'Invalid or Expired Token')

@section('auth-content')
<div class="text-center">
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
        <h4>Invalid or Expired Token</h4>
        <p class="mb-0">The authentication link you used is invalid or has expired.</p>
    </div>
    
    <div class="d-grid gap-2">
        <a href="{{ route('auth.login') }}" class="btn btn-auth">
            <i class="fas fa-paper-plane"></i> Request New Magic Link
        </a>
    </div>
</div>
@endsection

@section('auth-footer')
<p>Need help? <a href="mailto:support@lafab.com">Contact Support</a></p>
@endsection