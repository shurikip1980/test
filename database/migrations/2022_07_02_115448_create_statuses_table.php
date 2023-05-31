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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->nestedSet();
            $table->integer('show_main')->default(0);
            $table->timestamps();
        });

        Schema::create('status_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Status::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('lang', 5)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('title', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_langs');
        Schema::dropIfExists('statuses');
    }
};
