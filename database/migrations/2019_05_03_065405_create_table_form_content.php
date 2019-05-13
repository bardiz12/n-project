<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFormContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('form_id');
            $table->json('content');
            $table->integer('users_id');
            $table->float('long');
            $table->float('lat');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_form_content');
    }
}
