<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'stand',
        'photo',
        'desc',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
