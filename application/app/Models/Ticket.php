<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[] $fillable
     */
    protected $fillable = [
        'eventId',
        'policyId',
        'assetId',
        'stakeKey',
        'signatureNonce',
        'ticketNonce',
        'isCheckedIn',
        'signature',
        'checkInTime',
        'checkInUser',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $dates = [
        'checkInTime',
    ];
}
