<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mirkova Kujna</title>
    <link rel="icon" href="/ikonica.ico" type="image/x-icon">
    @vite('resources/css/styles.css')
</head>
<body>

    @if (!session()->has('korisnicko_ime'))
        <script>
            window.location.href = "{{ url('/') }}"; // Prati sesiju, redirekcija ako korisnik nije ulogovan
        </script>
    @endif

    <!-- Nav meni -->
    <nav>
        <div class="logo">Mirkova Kujna</div>
        <ul>
            <li><a href="{{ url('/landingUser') }}">Početna</a></li>
            <li><a href="{{ url('/kontaktUser') }}">Kontakt</a></li>
            <li><a href="{{ url('/nalog') }}">Tvoja kujna</a></li>
            <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="border: none; background: none; cursor: pointer; font-size: 1.2rem; color: white; margin-top: 5.5%">
                    Odjavi se
                </button>
            </form>
        </li>
            
            <li>
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <input type="text" placeholder="Pretražite kujnu..." name="search" class="search-input">
                </form>
            </li>

        </ul>
    </nav>

    <!-- banner na pocetnoj -->
    <header class="hero">
        <div class="hero-content">
            <div class="hero-text">
                @if (session('korisnicko_ime'))
                    <h1>Ćao, {{ session('korisnicko_ime') }}!</h1>
                    <p style="font-family: 'Barriecito', sans-serif;">Dobrodošli nazad u Mirkovu kujnu!</p>
                @endif
            </div>
            <div class="hero-image">
                <img src="{{ Vite::asset('resources/css/slike/pocetna_banner.png') }}" alt="Banner">
            </div>
        </div>
    </header>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Mirkova Kujna - Uradio Mirko Popović SI 21/21</p>
    </footer>
</body>
</html>
