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
        Schema::create('pr_requests', function (Blueprint $table) {
            $table->id();
            $table->string('requestor_name');
            $table->unsignedBigInteger('department_id'); // Foreign key for departments table
            $table->string('item');
            $table->integer('qty');
            $table->string('unit');
            $table->text('purpose');
            $table->date('date_requested');
            $table->boolean('arrived')->default(false); // Yes or No
            $table->date('date_arrived')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pr_requests');
    }
};