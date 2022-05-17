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
            CREATE TRIGGER `invoice_item_total`
            BEFORE INSERT ON `invoice_items`
            FOR EACH ROW
            BEGIN
                SET @value := NEW.`qty` * NEW.`rate`;
                SET @discAmt := @value * (NEW.`disc` / 100);
                SET @tax := (@value - @discAmt) * (
                    SELECT (`rate`/100) FROM `taxes` WHERE `id` = (
                        SELECT `tax_id` FROM `inventories` WHERE `id` = NEW.`inventory_id`
                    )
                );
                SET NEW.`value` = @value;
                SET NEW.`discAmt` = @discAmt;
                SET NEW.`tax` = @tax;
                SET NEW.`total` = (@value - @discAmt) + @tax;
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
        DB::unprepared('DROP TRIGGER IF EXISTS `invoice_item_total`');
    }
};
