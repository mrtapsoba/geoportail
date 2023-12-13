<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SupprContributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('contributions');
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->string('objet', 100);
            $table->string('etat', 20);
            $table->text('description');
            $table->text('fichier');
            $table->unsignedInteger('couche_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('couche_id')->references('id')->on('couches')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
