<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'u_id';
    protected $fillable = [
        'u_username', 
        'u_password', 
        'u_fname', 
        'u_mname', 
        'u_lname', 
        'u_gender', 
        'u_contact', 
        'r_id', 
        'd_id',
        'user_icon'
    ];

    public function role() {
        return $this->belongsTo(Role::class, 'r_id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'd_id');
    }

    protected $hidden = ['u_password'];

    public function getAuthIdentifierName()
    {
        return 'u_username';
    }

    public function getAuthPassword()
    {
        return $this->u_password;
    }
}
