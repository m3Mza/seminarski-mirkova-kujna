<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recept;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReceptController extends Controller
{

    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'recipe-name' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'portions' => 'required|integer',
            'difficulty' => 'required|in:lako,osrednje,tesko',
            'image' => 'nullable|image',
            'ingredients' => 'required|array',
            'instructions' => 'required|array',
        ]);
    
        $recept = new Recept(); // Novi Recept (Model definisan u Models/Recept.php)
        $recept->recept_ime = $request->input('recipe-name'); 
        $recept->opis = $request->input('description');
        $recept->trajanje_pripreme = $request->input('duration');
        $recept->porcije = $request->input('portions');
        $recept->tezina = $request->input('difficulty');
        
        $recept->napravio = session('korisnicko_ime');  // uzima korisnicko ime iz sesije
        
        if ($request->hasFile('image')) { // opcionalna slika
            $imagePath = $request->file('image')->store('public/images');
            $recept->slika_recepta = $imagePath;
        }
    
        $recept->sastojci = json_encode($request->input('ingredients')); // cuva sastojke i instrukcije kao JSON
        $recept->instrukcije = json_encode($request->input('instructions')); // cuva sastojke i instrukcije kao JSON
    

        $recept->save();
        return redirect()->route('nalog')->with('success', 'Recept je uspešno sačuvan!');
    }

    // SEARCH
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $recepti = Recept::where('recept_ime', 'LIKE', '%' . $searchTerm . '%')->get();

        return view('pretraga', compact('recepti'));
    }

    public function show($id)
{
    $recept = Recept::findOrFail($id);
    return view('recept', compact('recept')); // Prikazuje podatke na stranici
}


// TVOJA KUJNA STRANICA

public function showUserRecipes()
{
    $username = session('korisnicko_ime');
    $userRecipes = DB::table('recepti')->where('napravio', $username)->get();

    return view('nalog', compact('userRecipes'));
}

public function destroy($id)
{
    DB::table('recepti')->where('id', $id)->delete();

    return redirect()->route('nalog')->with('success', 'Recept je uspešno obrisan!');
}

// Kad se klikne izmena izbacuje prozor sa popunjenom formom za recept
public function edit($id)
{
    $recipe = Recept::findOrFail($id);
    return view('editRecipe', compact('recipe'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'recipe-name' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|integer',
        'portions' => 'required|integer',
        'difficulty' => 'required|in:lako,osrednje,tesko',
        'image' => 'nullable|image',
        'ingredients' => 'required|array',
        'instructions' => 'required|array',
    ]);

    $recept = Recept::findOrFail($id); // Uzima id od recepta

    // updejtuje podatke u tabeli
    $recept->recept_ime = $request->input('recipe-name');
    $recept->opis = $request->input('description');
    $recept->trajanje_pripreme = $request->input('duration');
    $recept->porcije = $request->input('portions');
    $recept->tezina = $request->input('difficulty');

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/images');
        $recept->slika_recepta = $imagePath;
    }

    $recept->sastojci = json_encode($request->input('ingredients')); // 1 Cuva podatke kao JSON
    $recept->instrukcije = json_encode($request->input('instructions')); // 2

    $recept->save();

    return redirect()->route('nalog')->with('success', 'Recept je uspešno ažuriran!');
}




}








