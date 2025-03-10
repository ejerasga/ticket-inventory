<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('t_id');
            $table->string('t_control_no')->unique();
            $table->foreignId('s_id')->constrained('services')->onDelete('cascade');
            
            // Define 'req_by' first before 'f_name' and 'l_name'
            $table->foreignId('req_by')->constrained('users', 'u_id')->after('id'); // Reference users table
            
            $table->string('f_name')->after('req_by'); // First name
            $table->string('l_name')->after('f_name'); // Last name
            
            $table->foreignId('d_id')->constrained('departments')->onDelete('cascade');
            $table->foreignId('received_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('located_at')->constrained('locations')->onDelete('cascade');
            $table->text('description');
            $table->timestamp('date_requested')->default(now());
            $table->timestamp('date_needed')->nullable();
            $table->time('time_needed')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
