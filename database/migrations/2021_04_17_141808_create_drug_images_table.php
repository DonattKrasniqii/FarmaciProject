<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('drug_id');
            $table->boolean('is_main');
            $table->string('image');
            $table->timestamps();

            $table->foreign('drug_id', 'drug_drug_images_fk1')
                ->references('id')
                ->on('drugs')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_images');
    }
}
