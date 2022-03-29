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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string("prenom");
            $table->integer("age");
            $table->string('email')->unique();
            $table->string('mdp');
            $table->date('ddn');
            $table->string("genre");
            $table->boolean("favori")->default(false);
            $table->foreignId("role_id")->constrained("roles", "id")->onDelete("cascade")->onUpdate("cascade");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
