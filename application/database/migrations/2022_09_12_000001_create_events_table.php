<?php

use App\Models\Event;
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
            $table->timestamps();
        });

        // Seed an example event
        $exampleEvent = new Event;
        $exampleEvent->fill([
            'uuid' => '7fdc027f-d1c3-4385-bf1b-aa9e0e81b133', // UUID v4
            'name' => 'Example Event',
            'policyIds' => [
                '5fa72fbeecbe80a3e15de1cacab54ba5e310e2c36ae85351132ed4ad',
            ],
            'nonceValidForMinutes' => 15,
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
