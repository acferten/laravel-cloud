<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->ulid('id', 10)->primary();
            $table->string('name');
            $table->ulid('parent_id', 10);
            $table->foreign('parent_id')->references('id')->on('folders')->onDelete('cascade');
            $table->foreignIdFor('author_id')->constrained('users');

//            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coauthor_id')->references('id')->on('users');
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
        Schema::dropIfExists('folders');
    }
};
