<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('req_by')->constrained('users', 'u_id')->after('id'); // Reference users table
            $table->string('f_name')->after('req_by'); // First name
            $table->string('l_name')->after('f_name'); // Last name
        });
    }

    public function down(): void {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['req_by']);
            $table->dropColumn(['req_by', 'f_name', 'l_name']);
        });
    }
};

