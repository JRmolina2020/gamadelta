<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'price', 'price_two', 'cost', 'stock', 'categorie_id'
    ];
    public function facture_detail()
    {
        return $this->belongsTo('App\Models\FactureDetail');
    }
}
