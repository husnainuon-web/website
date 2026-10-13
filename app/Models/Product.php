<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'stock',
        'main_image',
        'main_video',
        'specifications',
        'tags',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'specifications' => 'array',
        'tags' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
