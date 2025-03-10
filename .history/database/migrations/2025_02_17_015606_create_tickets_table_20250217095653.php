<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('t_id'); // Primary Key
            $table->string('t_control_no')->unique(); // Unique ticket control number
            $table->unsignedBigInteger('s_id'); // Foreign Key (Services)
            $table->unsignedBigInteger('req_by'); // Foreign Key (Users - Requested By)
            $table->string('f_name'); // First Name
            $table->string('l_name'); // Last Name
            $table->unsignedBigInteger('d_id'); // Foreign Key (Departments)
            $table->unsignedBigInteger('received_by')->nullable(); // Foreign Key (Users - Received By)
            $table->unsignedBigInteger('located_at'); // Foreign Key (Locations)
            $table->text('description'); // Ticket description
            $table->tinyInteger('status')->default(0); // 0: For Approval, 1: In Progress, 2: For Evaluation
            $table->tinyInteger('final_status')->default(0); // 0: Ongoing, 1: Done
            $table->timestamp('date_requested')->useCurrent(); // Auto-fill on creation
            $table->timestamp('date_needed')->nullable();
            $table->timestamp('time_needed')->nullable();
            $table->timestamps(); // Laravel's created_at & updated_at

            // Foreign Key Constraints
            $table->foreign('s_id')->references('s_id')->on('services')->onDelete('cascade');
            $table->foreign('req_by')->references('u_id')->on('users')->onDelete('cascade');
            $table->foreign('d_id')->references('d_id')->on('departments')->onDelete('cascade');
            $table->foreign('received_by')->references('u_id')->on('users')->onDelete('cascade');
            $table->foreign('located_at')->references('l_id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('tickets');
    }
};
