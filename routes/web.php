<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceptController;
use App\Http\Controllers\LoginController;



// Guest i Registrovane stranice

Route::get('/', function () {
    return view('landing');
});
Route::get('/landingUser', function () {
    // Redirekcija ako nije ulogovan korisnik
    if (!session()->has('korisnicko_ime')) {
        return redirect('/')->withErrors(['access' => 'Prvo se morate prijaviti.']);
    }
    return view('landingUser');
});

Route::get('/kontakt', function () {
    return view('kontakt');
});
Route::get('/kontaktUser', function () {
    if (!session()->has('korisnicko_ime')) {
        return redirect('/')->withErrors(['access' => 'Prvo se morate prijaviti.']); // Redirekcija ako nije ulogovan korisnik
    }
    return view('kontaktUser');
});


// Registracija, Prijava, Odjava

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/registracija', function () {
    return view('registracija');
});
Route::post('/registracija', [LoginController::class, 'registracija'])->name('registracija');

Route::post('/odjava', [LoginController::class, 'logout'])->name('logout');



// Search

Route::get('/search', [ReceptController::class, 'search'])->name('search');
Route::get('/recept/{id}', [ReceptController::class, 'show'])->name('recept.show');


// Tvoja kujna

Route::get('/nalog', [ReceptController::class, 'showUserRecipes'])->name('user.dashboard'); // 1 Rute za prikaz "Tvoje kujne" i prikaz korisnikovih recepata
Route::get('/nalog/recipes', [ReceptController::class, 'showUserRecipes'])->name('nalog'); // 2

Route::post('/recipes', [ReceptController::class, 'store'])->name('recipes.store'); // Forma za ubacivanje recepata

Route::delete('/recept/delete/{id}', [ReceptController::class, 'destroy'])->name('recept.destroy'); // Brisanje recepta

Route::get('/recept/edit/{id}', [ReceptController::class, 'edit'])->name('recept.edit'); // Izmena recepta

Route::post('/recept/update/{id}', [ReceptController::class, 'update'])->name('recept.update'); // Update recepta u bazi




