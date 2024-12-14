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

   
    <h1 style="margin-left: 2%; font-size:5rem;">Rezultati Pretrage: </h1>

@if($recepti->isEmpty())
    <p>Nema rezultata za vašu pretragu.</p>
@else
    <ul style="margin-left: 2%; font-size: 2rem;">
        @foreach ($recepti as $recept)
            <li><a href="{{ url('/recept/' . $recept->id) }}">{{ $recept->recept_ime }}</a></li>
        @endforeach
    </ul>
@endif


      <!-- Footer -->
      <footer>
        <p>&copy; 2024 Mirkova Kujna - Uradio Mirko Popović SI 21/21</p>
    </footer>
</body>
</html>