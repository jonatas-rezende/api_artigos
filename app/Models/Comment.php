<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [ 'grade', 'comment', 'articleId' ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'id');
    }

}
