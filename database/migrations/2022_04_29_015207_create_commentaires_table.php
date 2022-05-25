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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tache_id')->unsigned()->nullable();
            $table->bigInteger('sous_tache_id')->unsigned()->nullable();
            $table->bigInteger('personnel_id')->unsigned()->nullable();
            $table->text('description');
            $table->binary('image')->nullable();
            $table->binary('file')->nullable();
            $table->timestamps();

            $table->foreign('tache_id')
                ->references('id')
                ->on('taches')
                ->onDelete('cascade');
            $table->foreign('sous_tache_id')
                ->references('id')
                ->on('sous_taches')
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
        Schema::dropIfExists('commentaires');
    }
};
