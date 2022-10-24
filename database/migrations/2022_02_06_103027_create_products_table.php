<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sample_id')->unsigned()->nullable();
            //Editable  Start
            $table->string('name')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('unit_value')->default(0.00);
            $table->decimal('unit_price')->default(0.00);
            $table->decimal('total_price')->default(0.00);
            //Editable  END
            //Not Editable  Start
            $table->string('sample_name')->nullable();
            $table->string('sample_unit')->nullable();
            $table->decimal('sample_unit_value')->default(0.00);
            $table->decimal('sample_total_price')->default(0.00);
            $table->decimal('sample_unit_price')->default(0.00);
            //Not Editable  END
            $table->bigInteger('multiply_qty')->default(0);
            $table->string('status')->nullable(); //temp,pending etc
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
        Schema::dropIfExists('products');
    }
}
