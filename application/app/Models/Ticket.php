<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
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

    protected $dates = [
        'checkInTime',
    ];
}
