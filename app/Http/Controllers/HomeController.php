<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // KATALOG PUBLIK
    public function index()
    {
        $buku = Buku::all();
        return view('home.index', compact('buku'));
    }

    public function search(Request $request)
    {
        $buku = Buku::where('judul', 'like', '%' . $request->keyword . '%')
                    ->get();

        return view('home.index', compact('buku'));
    }
}
