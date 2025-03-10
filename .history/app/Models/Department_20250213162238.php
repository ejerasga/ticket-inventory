<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $primaryKey = 'd_id'; // primary key
    protected $fillable = ['d_name'];

    public $timestamps = false; // `created_at` and `updated_at` are NULL


    public function users() {
        return $this->hasMany(User::class, 'd_id');
    }

}
