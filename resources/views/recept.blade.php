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

<!-- Recept dinamicna stranica -->
<div style="display: flex; margin: 2%; font-family: Arial, sans-serif;">
    
    <!-- Leva sekcija -->
    <div style="width: 60%;">
        <h1 style="font-size: 4rem;">{{ $recept->recept_ime }}</h1>
        <p style="font-size: 1.2rem;">{{ $recept->opis }}</p>

        <div style="display: flex; gap: 5%; margin-top: 20px; font-size: 1.1rem;">
            <div style="color: #333;"><strong>Trajanje:</strong> {{ $recept->trajanje_pripreme }} minuta</div>
            <div style="color: #333;"><strong>•</strong></div>
            <div style="color: #333;"><strong>Težina:</strong> {{ ucfirst($recept->tezina) }}</div>
            <div style="color: #333;"><strong>•</strong></div>
            <div style="color: #333;"><strong>Porcije:</strong> {{ $recept->porcije }}</div>
        </div>
    </div>

    <!-- Desna sekcija -->
    <div style="width: 40%; text-align: center;">
        @if ($recept->slika_recepta)
            <img src="{{ Storage::url($recept->slika_recepta) }}" alt="Slika recepta" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
        @else
            <p style="font-style: italic; color: gray;">Nema slike za ovaj recept.</p>
        @endif
    </div>
</div>

<!-- Prikaz JSON fajlova kao liste -->
<div style="margin: 2%; font-family: Arial, sans-serif;">

    <div style="display: flex; gap: 5%;">

        <!-- Instrukcije -->
        <div style="width: 50%; background-color: #f9f9f9; padding: 2%; border-radius: 1%; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
            <h2 style="color: #5e2b1f; border-bottom: 2px dotted #5e2b1f; padding-bottom: 2%;">Instrukcije</h2>
            <br>
            <ul style="list-style-type: square; color: #333; font-size: 1rem; padding-left: 2%;">
                @foreach (json_decode($recept->instrukcije, true) as $instruction)
                    <li style="margin-bottom: 10px;">{{ $instruction }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Sastojci -->
        <div style="width: 50%; background-color: #f9f9f9; padding: 2%; border-radius: 1%; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
            <h2 style="color: #5e2b1f; border-bottom: 2px dotted #5e2b1f; padding-bottom: 2%;">Sastojci</h2>
            <br>
            <ul style="list-style-type: disc; color: #333; font-size: 1rem; padding-left: 2%;">
                @foreach (json_decode($recept->sastojci, true) as $ingredient)
                    <li style="margin-bottom: 10px;">{{ $ingredient }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>








 <!-- Footer -->
 <footer>
        <p>&copy; 2024 Mirkova Kujna - Uradio Mirko Popović SI 21/21</p>
    </footer>
</body>
</html>