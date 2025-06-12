@extends('Layouts.Main')
@section('title', 'Register')
@section('main')
<div class="min-h-screen flex items-center justify-center bg-base-200">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-center text-3xl font-bold mb-6">Register</h2>

            <form method="POST" action="{{ route('api.register') }}">
                @csrf
                <div class="form-control mb-4">
                    <label for="name" class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Your Name"
                        class="input input-bordered w-full @error('name') input-error @enderror"
                        value="{{ old('name') }}"
                        required
                        autocomplete="name"
                        autofocus
                    />
                    @error('name')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="student_id" class="label">
                        <span class="label-text">Student ID</span>
                    </label>
                    <input
                        type="text"
                        id="student_id"
                        name="student_id"
                        placeholder="Your Student ID"
                        class="input input-bordered w-full @error('student_id') input-error @enderror"
                        value="{{ old('student_id') }}"
                        required
                        autocomplete="student_id"
                    />
                    @error('student_id')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="your@email.com"
                        class="input input-bordered w-full @error('email') input-error @enderror"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    />
                    @error('email')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="role" class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select
                        id="role"
                        name="role"
                        class="select select-bordered w-full @error('role') select-error @enderror"
                        required
                    >
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select Role</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="password" class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="*********"
                        class="input input-bordered w-full @error('password') input-error @enderror"
                        required
                        autocomplete="new-password"
                    />
                    @error('password')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-6">
                    <label for="password_confirmation" class="label">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="••••••••"
                        class="input input-bordered w-full"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">Register</button>
                </div>
            </form>

            <div class="divider">OR</div>
            <div class="text-center mt-4">
                <p class="text-sm">Already have an account?
                    <a href="{{ route('login') }}" class="link link-hover link-primary font-bold">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection