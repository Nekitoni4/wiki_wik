<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atoms extends Model
{
    use HasFactory;

    public $table = 'atom';

    public $fillable = ['title'];

    public function articles() {
        return $this->belongsToMany(Articles::class, 'atom_article', 'atom_id', 'article_id')
            ->using(AtomArticle::class)->withPivot('occurrences');
    }
}
