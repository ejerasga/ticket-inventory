<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pc_specs', function (Blueprint $table) {
            $table->id();
            $table->string('name_deployed');
            $table->unsignedBigInteger('department_id');
            $table->string('location');
            $table->json('image_filenames')->nullable(); // Using JSON type for multiple filenames
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pc_specs');
    }
};