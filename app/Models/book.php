<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'category_id',
        'publish_year',
        'availability',
        'stock',
        'image_path',
    ];
    public function category()
{
    return $this->belongsTo(Category::class);
}
    public function bookIssues()
    {
        return $this->hasMany(Book_issue::class);
    }
}
