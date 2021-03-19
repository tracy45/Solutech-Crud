<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_number'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_details', 'order_id', 'product_id');
    }
}
