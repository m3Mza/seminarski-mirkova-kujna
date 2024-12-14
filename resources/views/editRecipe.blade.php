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



<h1 style="margin-left: 2%;">Izmeni recept: {{ $recipe->recept_ime }}</h1>

<form method="POST" action="{{ route('recept.update', $recipe->id) }}" enctype="multipart/form-data" class="contact-form" style="margin-bottom: 8%;">
    @csrf
    @method('POST')

    <div class="form-group">
        <label for="recipe-name">Ime recepta:</label>
        <input type="text" id="recipe-name" name="recipe-name" value="{{ old('recipe-name', $recipe->recept_ime) }}" required>
    </div>

    <div class="form-group">
        <label for="description">Kratak opis recepta:</label>
        <textarea id="description" name="description" rows="3" required>{{ old('description', $recipe->opis) }}</textarea>
    </div>

    <div class="form-group">
        <label for="duration">Priprema (trajanje u minutima):</label>
        <input type="number" id="duration" name="duration" value="{{ old('duration', $recipe->trajanje_pripreme) }}" min="1" required>
    </div>

    <div class="form-group">
        <label for="portions">Porcije:</label>
        <input type="number" id="portions" name="portions" value="{{ old('portions', $recipe->porcije) }}" min="1" required>
    </div>

    <div class="form-group">
        <label for="difficulty">Težina:</label>
        <select id="difficulty" name="difficulty" required>
            <option value="lako" {{ $recipe->tezina == 'lako' ? 'selected' : '' }}>Lako</option>
            <option value="osrednje" {{ $recipe->tezina == 'osrednje' ? 'selected' : '' }}>Osrednje</option>
            <option value="tesko" {{ $recipe->tezina == 'tesko' ? 'selected' : '' }}>Teško</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Importuj sliku:</label>
        <input type="file" id="image" name="image" accept="image/*">
    </div>

    <div class="form-group">
        <label>Sastojci:</label>
        <div id="ingredient-list">
            @foreach (json_decode($recipe->sastojci) as $ingredient)
                <div class="dynamic-list">
                    <input type="text" name="ingredients[]" value="{{ $ingredient }}" placeholder="Sastojak" required>
                    <button type="button" onclick="this.parentElement.remove()">Ukloni</button>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addIngredient()">Dodaj sastojak</button>
    </div>

    <div class="form-group">
        <label>Instrukcije:</label>
        <div id="instruction-list">
            @foreach (json_decode($recipe->instrukcije) as $instruction)
                <div class="dynamic-list">
                    <input type="text" name="instructions[]" value="{{ $instruction }}" placeholder="Korak" required>
                    <button type="button" onclick="this.parentElement.remove()">Ukloni</button>
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addInstruction()">Dodaj korak</button>
    </div>

    <div class="form-group">
        <button type="submit">Ažuriraj recept</button>
    </div>
</form>

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
</script>



<!-- Footer -->
<footer>
        <p>&copy; 2024 Mirkova Kujna - Uradio Mirko Popović SI 21/21</p>
    </footer>
</body>
</html>