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


     <header class="hero">
        <div class="hero-content">
            <div class="hero-text">
                @if (session('korisnicko_ime'))
                    <h1>Tvoja kuhinja, {{ session('korisnicko_ime') }}!</h1>
                    <p style="font-family: 'Barriecito', sans-serif;">Ovde možeš kreirati recepte i menjati ih!</p>
                @endif
            </div>
            </div>
        </div>
    </header>



    <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data" class="contact-form" style="margin-bottom: 10%;">
  @csrf
  <div class="form-group">
    <label for="recipe-name">Ime recepta:</label>
    <input type="text" id="recipe-name" name="recipe-name" required>
  </div>

  <div class="form-group">
    <label for="description">Kratak opis recepta:</label>
    <textarea id="description" name="description" rows="3" required></textarea>
  </div>

  <div class="form-group">
    <label for="duration">Priprema (trajanje u minutima):</label>
    <input type="number" id="duration" name="duration" min="1" required>
  </div>

  <div class="form-group">
    <label for="portions">Porcije:</label>
    <input type="number" id="portions" name="portions" min="1" required>
  </div>

  <div class="form-group">
    <label for="difficulty">Težina:</label>
    <select id="difficulty" name="difficulty" required>
      <option value="lako">Lako</option>
      <option value="osrednje">Osrednje</option>
      <option value="tesko">Teško</option>
    </select>
  </div>

  <div class="form-group">
    <label for="image">Importuj sliku:</label>
    <input type="file" id="image" name="image" accept="image/*">
  </div>

  <div class="form-group">
    <label>Sastojci:</label>
    <div id="ingredient-list"></div>
    <button type="button" onclick="addIngredient()">Dodaj sastojak</button>
  </div>

  <div class="form-group">
    <label>Instrukcije:</label>
    <div id="instruction-list"></div>
    <button type="button" onclick="addInstruction()">Dodaj korak</button>
  </div>

  <div class="form-group">
    <button type="submit">Objavi recept!</button>
  </div>
</form>


<!-- Prikaz recepata, inline css, jer zeza styles.css ponekad -->

<div style=" width: 45%; background-color: #f9f9f9; padding: 1.5em; border-radius: 8px; box-shadow: 0 0.25em 1em rgba(0, 0, 0, 0.1); margin-bottom: 10%; margin-left: 25%;">
    
    <h2 style="
        text-align: center; 
        color: #5e2b1f; 
        border-bottom: 0.1em dotted #5e2b1f; 
        padding-bottom: 0.5em; 
        font-size: 1.5em;">
        Tvoji Recepti
    </h2>
    
    @if($userRecipes->isEmpty())
        <p style="
            text-align: center; 
            font-style: italic; 
            color: gray; 
            font-size: 1em; 
            margin-top: 1em;">
            Nema recepata. Dodaj prvi recept!
        </p>
    @else
        <ul style=" list-style-type: none; padding: 0; margin-top: 1em;">
            
            @foreach ($userRecipes as $recipe)
                <li style=" margin-bottom: 1em; border-bottom: 1px solid #ddd; padding-bottom: 0.75em;">
                    
                    <strong style="font-size: 1.2em;">{{ $recipe->recept_ime }}</strong>
                    
                    <p style=" margin: 0.5em 0; font-size: 1em; color: #333;">
                        {{ $recipe->opis }}
                    </p>
                    
                    <div style="display: flex; align-items: center; gap: 0.5em;">
                        <a href="{{ url('/recept/' . $recipe->id) }}" 
                           style=" color: #5e2b1f; text-decoration: none; font-size: 1em; padding-right: 3%;">
                            Pogledaj recept
                        </a>
                        
                        <!-- Izmena recepta -->
                        <a href="{{ url('/recept/edit/' . $recipe->id) }}" 
                           style="display: inline-block;">
                            <img src="{{ asset('/izmeni.png') }}" 
                                 alt="Izmeni" 
                                 style="width: 1.2rem; height: auto; vertical-align: middle;">
                        </a>
                        
                        <!-- Brisanje recepta -->
                        <a href="#" onclick="confirmDeletion('{{ $recipe->id }}')" 
                          style="display: inline-block;">
                            <img src="{{ asset('/obrisi.png') }}" 
                              alt="Obriši" 
                              style="width: 1.2rem; height: auto; vertical-align: middle;">
                        </a>

                        <form id="delete-form-{{ $recipe->id }}" action="{{ route('recept.destroy', $recipe->id) }}" method="POST" style="display: none;">
                          @csrf
                          @method('DELETE')
                        </form>

                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>









<script>
    function addIngredient() {
      const ingredientList = document.getElementById('ingredient-list');
      const newIngredient = document.createElement('div');
      newIngredient.className = 'dynamic-list';
      newIngredient.innerHTML = `<input type="text" name="ingredients[]" placeholder="Sastojak" required>
      <button type="button" onclick="this.parentElement.remove()">Ukloni</button>`;
      ingredientList.appendChild(newIngredient);
    }

    function addInstruction() {
      const instructionList = document.getElementById('instruction-list');
      const newInstruction = document.createElement('div');
      newInstruction.className = 'dynamic-list';
      newInstruction.innerHTML = `<input type="text" name="instructions[]" placeholder="Korak" required>
      <button type="button" onclick="this.parentElement.remove()">Ukloni</button>`;
      instructionList.appendChild(newInstruction);
    }

    function confirmDeletion(recipeId) {
        if (confirm("Brisanje recepta je trajno! Da li želite da nastavite?")) {
            document.getElementById(`delete-form-${recipeId}`).submit();
        }
    }
</script>


     <!-- Footer -->
     <footer>
        <p>&copy; 2024 Mirkova Kujna - Uradio Mirko Popović SI 21/21</p>
    </footer>
</body>
</html>