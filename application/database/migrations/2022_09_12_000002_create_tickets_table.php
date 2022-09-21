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
            $table->unsignedBigInteger('eventId')->index();
            $table->foreign('eventId')->references('id')->on('events');
            $table->string('policyId', 64)->index();
            $table->string('assetId', 64)->index();
            $table->string('stakeKey', 64)->index();
            $table->char('signatureNonce', 16)->charset('binary')->unique();
            $table->char('ticketNonce', 16)->charset('binary')->nullable()->unique();
            $table->boolean('isCheckedIn')->default(false);
            $table->longText('signature')->nullable();
            $table->dateTime('checkInTime')->nullable();
            $table->unsignedBigInteger('checkInUser')->index()->nullable();
            $table->foreign('checkInUser')->references('id')->on('users');
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
