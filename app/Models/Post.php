<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * A post(article) belongs to exact one user
     */
    public function autor()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * the content(text) of the article should be hidden
     */

     protected $hidden = ['content'];
}
