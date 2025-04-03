<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDeployed extends Model
{
    use HasFactory;

    protected $fillable = [
        'requested_by',
        'item_id',
        'department_id',
        'quantity',
        'purpose',
        'date_deployed',
        'location_id',
        'remark',
        'gatepass',
        'returning',
        'date_returned'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'item_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // In ItemDeployed model
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'l_id');
    }

    // In Location model
    public function deployedItems()
    {
        return $this->hasMany(ItemDeployed::class, 'location_id', 'l_id');
    }
}