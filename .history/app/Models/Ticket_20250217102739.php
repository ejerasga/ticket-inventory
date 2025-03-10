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


        'req_by', 
        'd_id', 
        'received_by',
        'located_at', 
        'description', 
        'date_requested',
        'date_needed', 
        'time_needed'
    ];

    public function service() {
        return $this->belongsTo(Service::class, 's_id');
    }

    public function requester() {
        return $this->belongsTo(User::class, 'req_by');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function location() {
        return $this->belongsTo(Location::class, 'located_at');
    }
}

