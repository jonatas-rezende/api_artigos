<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'content', 'authorId' ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'articleId');
    }
}
