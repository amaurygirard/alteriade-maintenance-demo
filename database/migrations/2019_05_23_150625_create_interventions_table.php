<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contrat_id');
            $table->enum('type',
              ['correctif','update','sauvegarde','minor_change','assistance','new_feature','autre']
            );
            $table->integer('minutes_spent');
            $table->dateTime('date');
            $table->longText('description');
            $table->tinyInteger('is_probono')->default(0);
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
}
