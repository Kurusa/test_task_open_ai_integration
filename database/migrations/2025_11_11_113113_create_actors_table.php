<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->text('description');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('gender')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->unsignedSmallInteger('age')->nullable();
            $table->timestamps();

            $table->unique(['email', 'description']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actors');
    }
};
