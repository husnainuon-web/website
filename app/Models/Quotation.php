<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table = 'quotations';

    protected $fillable = [
        'user_id',
        'product_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'quantity',
        'message',
        'status',
        'admin_message',
        'quoted_price',
    ];

    protected $casts = [
        'quoted_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
