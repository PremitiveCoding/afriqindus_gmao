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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('reference');
            $table->foreignId('fournisseur_id')->constrained(); 
            $table->string('marque');
            $table->double('prixAchat');
            $table->double('prixVente');
            $table->string('emplacement');
            $table->string('type');
            $table->string('unite');
            $table->string('designation');
            $table->Integer('stockMin')->default(0);
            $table->Integer('quantite')->default(0);
            $table->boolean('vente')->default(false);
            $table->boolean('location')->default(false);
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
        Schema::dropIfExists('articles');
    }
};
