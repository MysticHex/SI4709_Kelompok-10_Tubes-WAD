<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mahasiswa Dashboard')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="drawer">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content">
            <div class="navbar bg-base-100 shadow">
                <div class="flex-none">
                    <label for="my-drawer" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1">
                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-ghost text-xl">Mahasiswa Panel</a>
                </div>
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img alt="User Avatar"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=random" />
                        </div>
                    </label>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ route('mahasiswa.update.profile') }}">Profile</a></li>
                        <li><a href="{{ route('mahasiswa.tak.create') }}">Input TAK</a></li>
                        <li><a href="{{ route('mahasiswa.feedback') }}">Feedback</a></li>
                        <li>
                            <form method="POST" action="{{ route('api.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-ghost w-full text-left">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="p-6">
                @yield('main')
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu p-4 w-64 min-h-full bg-base-200 text-base-content">
                <li><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('mahasiswa.tak.create') }}">Input TAK</a></li>
                <li><a href="{{ route('mahasiswa.feedback') }}">Feedback</a></li>
            </ul>
        </div>
    </div>
</body>

@yield('scripts')

</html>
