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
        Schema::create('booking_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\MuayThaiClass::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->integer('studied_hour')->default(0);
            $table->string('status')->default('in_progress');
            $table->date('date')->default(\Carbon\Carbon::today());
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
        Schema::dropIfExists('booking_class');
    }
};
