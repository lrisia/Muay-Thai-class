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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // primary key integer 'id' auto_increment
            $table->string('name', 50); // varchar(255)
            $table->string('username', 20)->unique(); // varchar(255)
            $table->string('email', 30)->nullable(); // chaining method
            $table->string('phone', 20)->unique();
            $table->string('password'); // varchar(60)
            $table->string('role')->default('USER');
            $table->string('address');
            $table->integer('hours')->default(0);
            $table->timestamp('email_verified_at')->nullable(); // timestamp, datetime
            $table->rememberToken(); // 'remember_token
            $table->timestamps(); // 'created_at', 'updated_at'
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
};
