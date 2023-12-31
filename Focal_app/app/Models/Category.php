<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function blogs()
    {

        return $this->belongsToMany(Blog::class, 'category_blog');
    }


    public function blogers()
    {
        return $this->belongsToMany(Bloger::class, 'bloger_intersts');
    }
}
