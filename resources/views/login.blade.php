<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava - Mirkova Kujna</title>
    <link rel="icon" href="/ikonica.ico" type="image/x-icon">
    @vite('resources/css/styles.css')
</head>

<body>

    <!-- Nav meni -->
    <nav>
        <div class="logo">Mirkova Kujna</div>
        <ul>
            <li><a href="{{ url('/') }}">Početna</a></li>
            <li><a href="{{ url('/kontakt') }}">Kontakt</a></li>
            <li><a href="{{ url('/login') }}">Prijavi se</a></li>
            <li>
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <input type="text" placeholder="Pretražite kujnu..." name="search" class="search-input">
                </form>
            </li>
        </ul>
    </nav>
    

    <div class="contact-form" style="margin-top: 5%">
    <h1>PRIJAVI SE</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="username">Korisničko ime</label>
            <input type="text" id="username" name="username" required>
            @error('username')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Lozinka</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        @if ($errors->has('credentials'))
            <span class="error-message">{{ $errors->first('credentials') }}</span>
        @endif
        <button type="submit" style="width: 25%">PRIJAVA</button>
    </form>
    <p style="padding-top: 5%">Nemaš nalog? <a href="{{ url('/registracija') }}">Registruj se!</a></p>
</div>


 <!-- Footer -->
 <footer>
        <p>&copy; 2024 Mirkova Kujna - Uradio Mirko Popović SI 21/21</p>
    </footer>
</body>
</html>