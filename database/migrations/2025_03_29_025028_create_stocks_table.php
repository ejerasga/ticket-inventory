<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id(); // Primary key column
            $table->string('item_code')->unique(); // Unique item code
            $table->string('item_name');
            $table->string('category');
            $table->string('description');
            $table->integer('stock_available'); // Integer column for stock quantity
            $table->string('uom'); // Unit of measure (pcs, copies, etc.)
            $table->timestamps(); // Laravel default created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
