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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('inv_ref');
            $table->date('inv_date');
            $table->foreignId('customer_id')->constrained();
            $table->decimal('value')->default(0);
            $table->decimal('disc')->default(0);
            $table->decimal('tax')->default(0);
            $table->decimal('total')->default(0);
            $table->decimal('round_off')->default(0);
            $table->decimal('grand_total')->default(0);
            $table->string('chal_no')->nullable();
            $table->date('chal_date')->nullable();
            $table->string('po_no')->nullable();
            $table->boolean('reverse_charge')->default(false);
            $table->string('transporter_name')->nullable();
            $table->string('lr_no')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->unique(['inv_ref', 'inv_date']);
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
        Schema::dropIfExists('invoices');
    }
};
