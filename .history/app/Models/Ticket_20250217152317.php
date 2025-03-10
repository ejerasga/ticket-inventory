<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    use HasFactory;

    protected $primaryKey = 't_id';
    protected $fillable = [
        's_id', 
        'located_at',
        'd_id', 
        'f_name',
        'l_name',
        'date_needed', 
        'time_needed',
        'description', 
        'req_by', 
        'received_by',
        'date_requested',
        'status',
        'final_status',
        'assigned_to'
    ];

    // Relationship with Service model
    public function service() {
        return $this->belongsTo(Service::class, 's_id');
    }

    // Relationship with User model (requester)
    public function requester() {
        return $this->belongsTo(User::class, 'req_by');
    }

    // Relationship with User model (receiver)
    public function receiver() {
        return $this->belongsTo(User::class, 'received_by');
    }

    // Relationship with Location model
    public function location() {
        return $this->belongsTo(Location::class, 'located_at');
    }

    // Relationship with Department model (add this)
    public function department() {
        return $this->belongsTo(Department::class, 'd_id', 'd_id');
    }
}
