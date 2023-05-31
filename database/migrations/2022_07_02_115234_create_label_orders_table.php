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
        Schema::create('label_orders', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Label::class)
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Order::class)
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('label_orders');
    }
};
