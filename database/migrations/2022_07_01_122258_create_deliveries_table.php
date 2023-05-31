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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('price')->default(0);
            $table->timestamps();
        });

        Schema::create('delivery_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Delivery::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('lang', 5)->nullable();
            $table->string('name', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_langs');
        Schema::dropIfExists('deliveries');
    }
};
