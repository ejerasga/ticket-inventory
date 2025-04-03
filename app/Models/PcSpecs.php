<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcSpecs extends Model
{
    use HasFactory;

    protected $table = 'pc_specs';

    protected $fillable = [
        'name_deployed',
        'department_id',
        'location_id', // Changed from location to location_id
        'image_filenames'
    ];

    protected $casts = [
        'image_filenames' => 'array',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'l_id');
    }
}