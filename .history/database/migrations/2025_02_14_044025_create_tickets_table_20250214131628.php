<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('t_id'); // Primary key t_id
            $table->string('t_control_no'); // control number for the ticket
            $table->unsignedBigInteger('s_id'); // foreign key to services (you'll need to create this reference)
            $table->unsignedBigInteger('req_by'); // foreign key to users table (for the user who requested it)
            $table->string('f_name'); // first name
            $table->string('l_name'); // last name
            $table->unsignedBigInteger('d_id'); // foreign key (department)
            $table->unsignedBigInteger('received_by'); // foreign key (received by user)
            $table->unsignedBigInteger('located_at'); // foreign key (location)
            $table->text('description'); // description of the ticket
            $table->timestamp('date_requested'); // timestamp for when it was requested
            $table->timestamp('date_needed'); // timestamp for when it is needed
            $table->timestamp('time_needed'); // time when needed
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraints
            $table->foreign('req_by')->references('u_id')->on('users')->onDelete('cascade'); // assuming the users table's primary key is 'u_id'
            $table->foreign('s_id')->references('s_id')->on('services')->onDelete('cascade'); // assuming 'services' table exists
            $table->foreign('d_id')->references('d_id')->on('departments')->onDelete('cascade'); // assuming 'departments' table exists
            $table->foreign('received_by')->references('u_id')->on('users')->onDelete('cascade'); // received by user
            $table->foreign('located_at')->references('l_id')->on('locations')->onDelete('cascade'); // assuming 'locations' table exists
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
