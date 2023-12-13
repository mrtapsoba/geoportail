<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DelAndCreateCouche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('couches');
        Schema::create('couches', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->text('fichier');
            $table->text('description');
            $table->integer('annee_prod');
            $table->unsignedInteger('sous_thematique_id');
            $table->timestamps();
            $table->foreign('sous_thematique_id')->references('id')->on('sousthematiques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
