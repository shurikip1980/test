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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('department')->nullable();
            $table->string('address')->nullable();
            $table->integer('delivery')->default(0);
            $table->integer('payment')->default(0);
            $table->string('currency_sign')->nullable();
            $table->integer('status')->default(1);
            $table->integer('paid')->default(0);
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->integer('order_discount')->default(0);
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
