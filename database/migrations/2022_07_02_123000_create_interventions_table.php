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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->foreignId('site_id')->constrained();
            $table->string('type');
            $table->text('desc');
            $table->text('urgence');
            $table->string('status')->default('Planifiée');
            $table->DateTime('dateDb');
            $table->DateTime('dateFn');
            $table->string('etat')->default('Ouvert');
            $table->time('tempsNes');
            $table->string('frequence')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interventions');
    }
};
