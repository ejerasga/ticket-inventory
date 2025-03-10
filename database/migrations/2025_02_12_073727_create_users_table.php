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
        Schema::create('users', function (Blueprint $table) {
            $table->id('u_id');
            $table->string('u_username')->unique(); // Username must be unique
            $table->string('u_password');
            $table->string('u_fname');
            $table->string('u_mname')->nullable(); // Not all have middle name
            $table->string('u_lname');
            $table->boolean('u_gender'); // 1 = Male, 0 = Female
            $table->string('u_contact');
            $table->foreignId('r_id')->constrained('roles', 'r_id');
            $table->foreignId('d_id')->constrained('departments', 'd_id');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
