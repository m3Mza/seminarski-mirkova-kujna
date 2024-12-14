<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Registracija
    public function registracija(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:korisnici,korisnicko_ime|max:255',
            'password' => 'required|min:8',
        ]);

        // Hash lozinka
        $hashedPassword = Hash::make($request->password);

        // Insert korisnik
        DB::table('korisnici')->insert([
            'korisnicko_ime' => $request->username,
            'lozinka' => $hashedPassword,
        ]);

        // Redirekcija nakon registracije
        return redirect('/login')->with('success', 'Registracija uspešna! Sada se možete prijaviti.');
    }

    // Prijava
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('korisnici')->where('korisnicko_ime', $request->username)->first();

        if ($user && Hash::check($request->password, $user->lozinka)) {
            // Uspešna prijava - Postavljanje sesije
            $request->session()->put('korisnicko_ime', $user->korisnicko_ime);

            return redirect('/landingUser')->with('success', 'Dobrodošli nazad!');
        }


        return redirect('/login')->withErrors([
            'credentials' => 'Korisničko ime ili lozinka nisu tačni.',
        ]);
    }

    // Odjava
    public function logout(Request $request)
    {
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect('/')->with('success', 'Uspešno ste se odjavili!');
    }
}
