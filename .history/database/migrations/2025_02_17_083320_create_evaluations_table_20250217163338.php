<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('evaluations', function (Blueprint $table) {
        $table->id('eval_id');
        $table->foreignId('u_id')->constrained('users', 'u_id');
        $table->integer('work_quality');
        $table->integer('res_delivery');
        $table->integer('personnells_quality');
        $table->integer('overall');
        $table->text('comments')->nullable();
        $table->integer('final_status')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
