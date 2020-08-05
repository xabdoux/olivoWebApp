<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->integer('tour');
            $table->string('zone_id')->nullable();
            $table->string('type', 100)->nullable()->default('principale');
            $table->integer('litre')->nullable();
            $table->integer('payed_by')->nullable();
            $table->timestamp('payed_at')->nullable();
            $table->timestamp('counted_at')->nullable();
            $table->integer('served_by')->nullable();
            $table->timestamp('served_at')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
