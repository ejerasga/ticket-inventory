<?php

return new class extends Migration {
    public function up() {
        Schema::create('locations', function (Blueprint $table) {
            $table->id('l_id');
            $table->string('located_at')->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('locations');
    }
};
