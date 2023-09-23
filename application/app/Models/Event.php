<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model {

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'uuid',
        'name',
        'policyIds',
        'nonceValidForMinutes',
        'hodlAsset',
        'startDateTime',
        'endDateTime',
        'location',
        'eventStart',
        'eventEnd',
        'eventDate',
        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'policyIds' => Json::class,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $dates = [
        'startDateTime',
        'endDateTime',
    ];

    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class, 'eventId');
    }

    public function description() {
        $description = "";
        if ($this->eventDate) {
            $description .= date('l jS \of F Y', strtotime($this->eventDate));
        }

        if ($this->eventStart && $this->eventEnd) {
            $description .= " " . $this->eventStart . " to " . $this->eventEnd . ".";
        } else if ($this->eventStart) {
            $description .= " " . $this->eventStart;
        } else if ($this->eventEnd) {
            $description .= " until " . $this->eventEnd;
        }

        if ($this->location) {
            $description .= " " . $this->location;
        }

        return $description;

    }
}
