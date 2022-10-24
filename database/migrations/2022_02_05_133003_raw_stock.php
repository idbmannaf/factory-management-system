<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RawStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('requisition_id')->unsigned()->nullable();
            $table->bigInteger('requisition_item_id')->unsigned()->nullable();
            $table->decimal('total_quantity',14,2)->default(0.00);
            $table->decimal('unit_price',14,2)->default(0.00);
            $table->bigInteger('raw_id')->unsigned()->nullable();
            $table->string('unit')->nullable();
            $table->decimal('unit_value',14,2)->default(0.00);
            $table->string('type')->nullable(); //raw, pack
            $table->bigInteger('addedBy_id')->unsigned()->nullable();
            $table->bigInteger('editedBy_id')->unsigned()->nullable();
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
        Schema::dropIfExists('raw_stocks');
    }
}
