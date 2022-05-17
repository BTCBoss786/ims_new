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
        DB::unprepared('
            CREATE TRIGGER `invoice_total`
            AFTER INSERT ON `invoice_items`
            FOR EACH ROW
            BEGIN
                SET @id := NEW.`invoice_id`;
                SET @value := 0;
                SET @disc := 0;
                SET @tax := 0;
                SELECT SUM(`value`), SUM(`discAmt`), SUM(`tax`) INTO @value, @disc, @tax FROM `invoice_items` WHERE `invoice_id` = @id;
                SET @total := (@value - @disc) + @tax;
                SET @grandTotal := CEIL(@total);
                SET @roundOff := @grandTotal - @total;
                UPDATE `invoices`
                SET `value` = @value,
                    `disc` = @disc,
                    `tax` = @tax,
                    `total` = @total,
                    `round_off` = @roundOff,
                    `grand_total` = @grandTotal
                WHERE `id` = @id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `invoice_total`');
    }
};
