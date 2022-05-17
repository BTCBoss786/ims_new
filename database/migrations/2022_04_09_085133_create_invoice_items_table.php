<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->foreignId('inventory_id')->constrained();
            $table->decimal('qty')->default(0);
            $table->decimal('rate')->default(0);
            $table->decimal('disc')->default(0);
            $table->decimal('value')->default(0);
            $table->decimal('discAmt')->default(0);
            $table->decimal('tax')->default(0);
            $table->decimal('total')->default(0);
            $table->string('hsn')->nullable();
            $table->foreignId('unit_id')->constrained();
            $table->unique(['invoice_id', 'inventory_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
};
