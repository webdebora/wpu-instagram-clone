<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
</head>
<body>
    <nav>
        <div>
            <a href="{{ route('profile.show') }}">Profile</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @yield('content') <!-- Tempat konten dari blade lainnya akan ditampilkan -->
    </div>
</body>
</html>
