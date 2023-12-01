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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('email');
            $table->string('org_type')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('establish_year')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->text('about')->nullable();
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade'); // Add onDelete if you want to cascade delete
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
        Schema::dropIfExists('employers');
    }
};
