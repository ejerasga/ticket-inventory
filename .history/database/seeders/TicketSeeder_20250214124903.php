<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder {
    public function run() {
        Ticket::create([
            't_control_no' => 'TCKT-20240214',
            's_id' => 1,
            'req_by' => 1,
            'd_id' => 1,
            'received_by' => 2,
            'located_at' => 1,
            'description' => 'Network issue in Makati office.',
            'date_requested' => now(),
            'date_needed' => now()->addDays(2),
            'time_needed' => '10:00:00'
        ]);
    }
}
    
