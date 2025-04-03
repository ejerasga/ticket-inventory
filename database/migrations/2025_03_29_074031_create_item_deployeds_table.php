<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('item_deployeds', function (Blueprint $table) {
            $table->id();
            $table->string('requested_by');
            $table->integer('item_id'); // This will store the ID from stocks table
            $table->integer('department_id'); // This will store the ID from departments table
            $table->integer('quantity'); 
            $table->text('purpose');
            $table->date('date_deployed');
            $table->integer('location_id');
            $table->text('remark')->nullable();
            $table->boolean('gatepass')->default(0);
            $table->boolean('returning')->default(0);
            $table->date('date_returned')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_deployeds');
    }
};
