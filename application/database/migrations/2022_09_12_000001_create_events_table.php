<?php

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
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
        Schema::create('events', static function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->json('policyIds');
            $table->unsignedInteger('nonceValidForMinutes');
            $table->boolean('hodlAsset')->default(false);
            $table->dateTime('startDateTime')->nullable();
            $table->dateTime('endDateTime');
            $table->timestamps();
        });

        // Seed an example event
        $now = Carbon::now();
        $exampleEvent = new Event;
        $exampleEvent->fill([
            'uuid' => Str::uuid()->toString(),
            'name' => 'Example Event',
            'policyIds' => [
                '5fa72fbeecbe80a3e15de1cacab54ba5e310e2c36ae85351132ed4ad',
            ],
            'nonceValidForMinutes' => 15,
            'hodlAsset' => false,
            'startDateTime' => $now->toDateTimeString(),
            'endDateTime' => $now->clone()->addDays(30)->toDateTimeString(),
        ]);
        $exampleEvent->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
