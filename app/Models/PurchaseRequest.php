<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequest extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseRequestFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(){
        
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function organization(){

        return $this->belongsTo(Organization::class, 'organization_id')->withDefault();
    }

    public function carts(){

        return $this->hasMany(Cart::class);
    }
    

}
