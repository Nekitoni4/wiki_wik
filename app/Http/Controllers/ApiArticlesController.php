<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\AtomArticle;
use App\Models\Atoms;
use Validator;
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
        $validator = Validator::make($request->json()->all(), [
           'title' => 'bail|required|unique:article',
            'content' => 'required:article',
            'count_words' => 'required',
            'size' => 'required',
            'url' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $content = $request->json()->get('content');
        $chunkedDescription = collect(explode(' ', collect(preg_split('/\n/', $content))
            ->filter(function ($sentence) {
               return $sentence != '';
            })
            ->map(function ($sentence) {
               return preg_replace('/[^\w\s]/u', '', $sentence);
            })
            ->join(' ')))
            ->filter(function ($word) {
               return $word != '' && mb_strlen($word, 'UTF-8') > 2;
            })
            ->map(function($word) {
                return mb_strtolower($word);
            });
        $articleRow = Articles::create($request->json()->all());
        $counted = $chunkedDescription->countBy();
        $chunkedDescription->unique()->values()->each(function ($word) use ($articleRow, $counted) {
            $articleId = $articleRow->id;
            $occurrences = $counted[$word];
            $atom_id = null;
           if ($atom = Atoms::where('title', $word)->first()) {
               $atom_id = $atom->id;
           } else {
               $atom = Atoms::create([
                  'title' => $word
               ]);
               $atom_id = $atom->id;
           }
            AtomArticle::create([
                'atom_id' => $atom_id,
                'article_id' => $articleId,
                'occurrences' => $occurrences
            ]);
        });
        return $articleRow;
    }
}
