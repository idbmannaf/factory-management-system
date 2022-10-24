<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackReqTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_req_temps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('requisition_id')->unsigned()->nullable();
            $table->bigInteger('pack_cat_id')->unsigned()->nullable();
            $table->bigInteger('row_cat_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->integer('product_id')->nullable();
            $table->bigInteger('qty')->default(0);
            $table->string('product_name')->nullable();
            $table->string('unit')->nullable();
            $table->bigInteger('unit_value')->default(0);
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
        Schema::dropIfExists('pack_req_temps');
    }
}
