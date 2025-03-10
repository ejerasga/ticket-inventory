<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'r_id'; // primary key
    protected $fillable = ['r_name'];

    public $timestamps = false; // `created_at` and `updated_at` are NULL

        
    public function users() {
        return $this->hasMany(User::class, 'r_id');
    }

}
