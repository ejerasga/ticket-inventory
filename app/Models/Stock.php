<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // Specify the table name (optional if it's the plural form of the model)
    protected $table = 'stocks'; 

    // Specify the fillable columns
    protected $fillable = [
        'item_code', 'item_name', 'category', 'description', 'stock_available', 'uom',
    ];
}
