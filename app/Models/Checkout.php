<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    /** @use HasFactory<\Database\Factories\CheckoutFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class, 'cart_item_id')->withDefault();
    }

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class, 'purchase_request_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class . 'user_id')->withDefault();
    }
}
