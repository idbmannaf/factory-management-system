<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32)
                  ->nullable()
                  ->index();
            $table->string('username', 32)
                  ->nullable()
                  ->index();
            $table->string('email', 32)
                  ->nullable()
                  ->index();
            $table->string('mobile', 32)
                  ->nullable()
                  ->index();

            $table->string('mobile_country', 2)
                  ->nullable();

            $table->string('calling_code', 5)
                  ->nullable();

            $table->string('currency_code', 3)
                  ->nullable();

            $table->string('nid')->nullable();

            $table->string('img_name')->nullable();
            $table->char('gender', 10)->nullable(); //male female other
            $table->date('dob')->nullable(); //date of birth
            $table->string('password');
            $table->string('password_temp')->nullable();

            // $table->string('api_token', 80)
            //             ->unique()
            //             ->nullable()
            //             ->default(null);

            $table->rememberToken();
            $table->boolean('active')->default(1);
            $table->string('addedby_type')->nullable(); // polymorphism model
            $table->bigInteger('addedby_id')->unsigned()->nullable(); //polymorphism id
            // $table->char('gender', 7);
            // $table->date('date_of_birth');
            $table->integer('user_status')->default(1);
            //1=user,2=smartshop //3=institution
            $table->timestamps();
            $table->timestamp('loggedin_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('mobile_verify_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
