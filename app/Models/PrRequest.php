<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'requestor_name',
        'department_id',
        'item',
        'qty',
        'unit',
        'purpose',
        'date_requested',
        'arrived',
        'date_arrived',
        'remarks',
    ];

    protected $casts = [
        'arrived' => 'boolean',
        'date_requested' => 'date',
        'date_arrived' => 'date',
    ];

    // Define the relationship with the Department model
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}