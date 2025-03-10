<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $primaryKey = 'eval_id';
    
    protected $fillable = [
        'u_id',
        'work_quality',
        'res_delivery',
        'personnels_quality',
        'overall',
        'comments',
        'final_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'u_id', 'u_id');
    }
}
