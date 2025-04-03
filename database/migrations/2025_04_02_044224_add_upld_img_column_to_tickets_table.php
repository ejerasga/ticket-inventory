<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpldImgToTicketsTable extends Migration {
    public function up() {
        Schema::table('tickets', function (Blueprint $table) {
            $table->json('upld_img')->nullable();
        });
    }

    public function down() {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('upld_img');
        });
    }
}
