<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
/**
     * Get the author .
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

       public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
