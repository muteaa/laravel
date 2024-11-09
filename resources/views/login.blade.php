@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-box">
        <h1 class="login-title">Please log in to continue.</h1>
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email Input -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-wrapper">
                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Enter your email address"
                        required
                        class="form-input"
                    />
                    <span class="input-icon">@</span>
                </div>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        required
                        minlength="6"
                        class="form-input"
                    />
                    <span class="input-icon">🔒</span>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-button">
                Log in <span class="arrow-icon">→</span>
            </button>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="error-message">
                    <span class="error-icon">⚠️</span>
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
