<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSousThematiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sous_thematiques', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->text('image');
            $table->unsignedInteger('thematique_id');
            $table->timestamps();
            $table->foreign('thematique_id')->references('id')->on('thematiques')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sous_thematiques');
    }
}
