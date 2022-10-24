<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('supplier_id')->unsigned()->nullable();
            $table->bigInteger('payment_by')->unsigned()->nullable();
            $table->decimal('previous_balance',14,2)->default(0.00);
            $table->decimal('moved_balance',14,2)->default(0.00);
            $table->decimal('new_balance',14,2)->default(0.00);
            $table->string('payment_method')->nullable();
            $table->string('account')->nullable();
            $table->text('note')->nullable();
            $table->bigInteger('addedBy_id')->unsigned()->nullable();
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
        Schema::dropIfExists('supplier_payments');
    }
}
