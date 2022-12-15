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
        Schema::create('trades_open', function (Blueprint $table) {
            $table->id();
            $table->time('openTime');
            $table->float('profit');
            $table->float('levier');
            $table->string('type');
        });

        DB::unprepared(DB::raw(file_get_contents("resources/data.sql"))); // Load old datas
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades_open');
    }
};
