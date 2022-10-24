<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawStockModifyHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_stock_modify_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stock_id')->unsigned()->nullable();
            $table->bigInteger('raw_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->decimal('previous_stock',20,2)->default(0.00);
            $table->decimal('addition',20,2)->default(0.00);
            $table->decimal('wastage',20,2)->default(0.00);
            $table->decimal('new_stock',20,2)->default(0.00);
            $table->text('remark')->nullable();
            $table->bigInteger('addeBy_id')->unsigned()->nullable();
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
        Schema::dropIfExists('raw_stock_modify_histories');
    }
}
