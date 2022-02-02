<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('advertise_type')->after('city_id')->default(3);
            $table->string('phone_number')->after('name')->nullable();
            $table->string('logo')->after('email')->nullable();
            $table->string('website_url')->after('logo')->nullable();
            $table->string('facebook_url')->after('website_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropColumns('users',['advertise_type','logo']);
    }
}
