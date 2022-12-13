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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->foreignId('article_id')->constrained();
            $table->string('description');
            $table->string('adresseLivraison');
            $table->date('dateLivraison');
            $table->integer('quantite');
            $table->string('status')->default('en cours de preparation');
            $table->double('total');
            $table->double('totalHTVA');
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
        Schema::dropIfExists('commandes');
    }
};
