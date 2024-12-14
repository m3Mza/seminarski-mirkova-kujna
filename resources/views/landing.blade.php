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


    <!-- Hero Section -->
    <header class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Dobrodošli u Mirkovu kujnu!</h1>
            <p style="font-family: 'Barriecito', sans-serif;">Vaše odredište za brze recepte!</p>
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
