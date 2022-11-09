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
        Schema::create('muay_thai_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('max_member');
            $table->integer('enrolled_member')->default(0);
            $table->string('status', 15)->default('available');
            $table->integer('total_class_hour');
            $table->date('open_date');
            $table->date('close_date');
            $table->integer('price');
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
        Schema::dropIfExists('muay_thai_class');
    }
};
