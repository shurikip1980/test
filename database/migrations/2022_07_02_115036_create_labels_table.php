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
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->nestedSet();
            $table->integer('show_main')->default(0);
            $table->timestamps();
        });

        Schema::create('label_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Label::class)
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
        Schema::dropIfExists('label_langs');
        Schema::dropIfExists('labels');
    }
};
