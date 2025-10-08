<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); 
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('isbn', 50)->unique();
            $table->unsignedBigInteger('category_id');
            $table->year('publish_year')->nullable();
            $table->enum('availability', ['Yes', 'No'])->default('Yes');
            $table->text('image_path')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
                                                
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};  
