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
        Schema::create('taches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('projet_id')->unsigned();
            $table->bigInteger('personnel_id')->unsigned();
            $table->string('titre');
            $table->date('deadline');
            $table->text('description');
            $table->string('etat');
            $table->timestamps();

            $table->foreign('projet_id')
                ->references('id')
                ->on('projets')
                ->onDelete('cascade');
            $table->foreign('personnel_id')
                ->references('id')
                ->on('personnels')
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
        Schema::dropIfExists('taches');
    }
};
