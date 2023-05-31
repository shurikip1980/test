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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->nestedSet();
            $table->integer('show_main')->default(0);
            $table->timestamps();
        });

        Schema::create('feature_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Feature::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('lang', 5)->nullable();
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_langs');
        Schema::dropIfExists('features');
    }
};
