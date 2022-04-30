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
        Schema::create('projets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ticket_id')->unsigned();
            $table->bigInteger('equipe_id')->unsigned();
            $table->string('project_name');
            $table->text('description');
            $table->date('deadline');
            $table->date('date_debut');
            $table->string('etat');
            $table->binary('file_cdc')->nullable();
            $table->binary('capture_dc')->nullable();
            $table->timestamps();

            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
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
        Schema::dropIfExists('projets');
    }
};
