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
        Schema::create('equipe_personnel', function (Blueprint $table) {
            $table->bigInteger('personnel_id')->unsigned();
            $table->bigInteger('equipe_id')->unsigned();

            $table->foreign('personnel_id')
                ->references('id')
                ->on('personnels')
                ->onDelete('cascade');
            $table->foreign('equipe_id')
                ->references('id')
                ->on('equipes')
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
        Schema::dropIfExists('equipe_personnels');
    }
};
