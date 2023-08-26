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
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('description');       // For MySQL 8.0 use string('name', 125);
            $table->enum('platform',['core','ci','laravel']);       // For MySQL 8.0 use string('name', 125);
            $table->integer('pid');        // For MySQL 8.0 use string('name', 125);
            $table->timestamps();

            $table->unique(['name']);
        });
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('description');       // For MySQL 8.0 use string('name', 125);
            $table->string('contact_person');       // For MySQL 8.0 use string('name', 125);
            $table->string('contact');       // For MySQL 8.0 use string('name', 125);
            $table->timestamps();

            $table->unique(['name']);
        });
        Schema::create('projects_has_clients', function (Blueprint $table) {
            $table->bigIncrements('id'); // permission id
            $table->string('project_id');       // For MySQL 8.0 use string('name', 125);
            $table->string('client_id'); 
        });
        Schema::table('projects_has_clients', function(Blueprint $table)
        {
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('projects_clients_tables');
    }
};
