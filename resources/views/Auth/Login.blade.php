@extends('Layouts.main')

@section('main')
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-2xl font-bold text-center mb-4">Login</h2>
                
                @if(session('error'))
                    <div class="alert alert-error mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('api.login') }}">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" placeholder="your@email.com" class="input input-bordered @error('email') input-error @enderror" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="password" placeholder="Password" class="input input-bordered @error('password') input-error @enderror" required>
                        @error('password')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                        <label class="label">
                            {{-- <a href="{{ route('password.request') }}" class="label-text-alt link link-hover">Forgot password?</a> --}}
                        </label>
                    </div>
                    
                    <div class="form-control mt-2">
                        <label class="cursor-pointer label justify-start gap-2">
                            <input type="checkbox" name="remember" class="checkbox checkbox-sm checkbox-primary" {{ old('remember') ? 'checked' : '' }}>
                            <span class="label-text">Remember me</span>
                        </label>
                    </div>
                    
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                
                <div class="divider">OR</div>
                
                <div class="text-center">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="link link-hover link-primary">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
