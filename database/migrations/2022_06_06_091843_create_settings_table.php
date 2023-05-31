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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->integer('time')->default(5);
            $table->string('email')->nullable();
            $table->string('link')->nullable();
            $table->text('map')->nullable();
            $table->text('key_novaposhta')->nullable();
            $table->date('date_novaposhta')->nullable();
        });

        Schema::create('setting_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Setting::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('lang', 5)->nullable();
            $table->string('address')->nullable();
            $table->string('site_name')->nullable();
            $table->text('text')->nullable();
            $table->string('work')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_langs');
        Schema::dropIfExists('settings');
    }
};
