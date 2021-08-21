<?php

namespace App\Http\Controllers;

use App\Models\Articles;

class ArticlesController extends Controller
{
    public function index() {
        return view('welcome')->with(['articles' => Articles::all()]);
    }
}
