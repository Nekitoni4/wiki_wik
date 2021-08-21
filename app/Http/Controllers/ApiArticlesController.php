<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class ApiArticlesController extends Controller
{
    // Регистрируем промежуточное ПО для нормализации URL, на клиентскую часть не надеемся
    public function __construct()
    {
        $this->middleware(function(Request $request, $next) {
            $request->json()->set('url', urldecode($request->json()->get('url')));
            return $next($request);
        });
    }

    /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Articles::all();
    }


    /**
     * Create of the article
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {
        $request->validate([
           'title' => 'unique:article'
        ]);
        return Articles::create($request->json()->all());
    }
}
