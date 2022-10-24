<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_productions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('product_name')->nullable();
            $table->string('category_name')->nullable();
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('pack')->default(0);
            $table->string('unit')->nullable();
            $table->bigInteger('unit_value');
            $table->string('type')->nullable();
            $table->bigInteger('type_value');
            $table->string('status')->default('pending'); //pending,approved,rejected
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
        Schema::dropIfExists('daily_productions');
    }
}
