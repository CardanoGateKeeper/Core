<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tickets', static function (Blueprint $table) {
            $table->id();
            $table->string('policyId', 64);
            $table->string('assetId', 64);
            $table->string('stakeKey', 64);
            $table->char('signatureNonce', 16)->charset('binary')->unique();
            $table->char('ticketNonce', 16)->charset('binary')->nullable()->unique();
            $table->boolean('isCheckedIn')->default(false);
            $table->longText('signature')->nullable();
            $table->dateTime('checkInTime')->nullable();
            $table->unsignedBigInteger('checkInUser')->nullable();
            $table->foreign('checkInUser')->references('id')->on('users');
            $table->unique(['stakeKey', 'policyId', 'assetId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
