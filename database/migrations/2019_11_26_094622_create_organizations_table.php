<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('organization_name');
            $table->string('organization_email')->unique();
            $table->string('organization_mobile')->unique();
            $table->string('organization_address');
            $table->string('organization_website');
            $table->string('organization_thumbnail');
            $table->string('organization_logo');
            $table->integer('status_active');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('organizations');
    }
}
