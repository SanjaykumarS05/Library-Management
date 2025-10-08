<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipient_id');
            $table->string('email', 255);
            $table->string('subject', 255);
            $table->text('message');
            $table->enum('status', ['Sent', 'Failed'])->default('Sent');
            $table->string('type', 255)->nullable();
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps();
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_logs');
    }
};
