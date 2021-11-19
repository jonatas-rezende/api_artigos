<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'email' ];

    public function article()
    {
        return $this->hasMany(Article::class, 'authorId');
    }
}
