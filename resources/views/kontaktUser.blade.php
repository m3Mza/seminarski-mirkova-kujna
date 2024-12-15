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
            
            <li>
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <input type="text" placeholder="Pretražite kujnu..." name="search" class="search-input">
                </form>
            </li>

        </ul>
    </nav>

    <section class="contact-section" style="padding: 5rem;">
        <div class="hero-content">
            <div class="hero-text" style="margin-left: 25%;">
                <h1>Kontaktirajte nas</h1>
                <p style="font-family: 'Barriecito', sans-serif;">Imaš ideje i predloge? Javi nam se preko forme!</p>
            </div>
        </div>

        <!-- Kontakt forma -->
        <div class="contact-form">
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Ime:</label>
                    <input type="text" id="name" name="name" placeholder="Vaše ime" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Vaš email" required>
                </div>
                <div class="form-group">
                    <label for="message">Poruka:</label>
                    <textarea id="message" name="message" placeholder="Vaša poruka..." required></textarea>
                </div>
                <button type="submit">POŠALJI</button>
            </form>
        </div>
    </section>

   <!-- Footer -->
   <footer>
        <p>&copy; 2024 Mirkova Kujna - Uradio Mirko Popović SI 21/21</p>
    </footer>
</body>
</html>
