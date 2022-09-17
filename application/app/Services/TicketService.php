<?php

namespace App\Services;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Ticket;

class TicketService
{
    public function findExistingTicket(int $eventId, string $policyId, string $assetId, string $stakeKey): ?Ticket
    {
        return Ticket::where('eventId', $eventId)
            ->where('policyId', $policyId)
            ->where('assetId', $assetId)
            ->where('stakeKey', $stakeKey)
            ->first();
    }

    public function createNewTicket(int $eventId, string $policyId, string $assetId, string $stakeKey): Ticket
    {
        $ticket = new Ticket;

        $ticket->fill([
            'eventId' => $eventId,
            'policyId' => $policyId,
            'assetId' => $assetId,
            'stakeKey' => $stakeKey,
            'signatureNonce' => Uuid::uuid4()->getBytes(),
        ]);

        $ticket->save();

        return $ticket;
    }

    public function setTicketNonceAndSignature(Ticket $ticket, string $signature): void
    {
        $ticket->update([
            'ticketNonce' => Uuid::uuid4()->getBytes(),
            'signature' => $signature,
        ]);
    }

    public function findTicketByQRCode(int $eventId, string $assetId, string $ticketNonce): ?Ticket
    {
        return Ticket::where('eventId', $eventId)
            ->where('assetId', $assetId)
            ->where('ticketNonce', Uuid::fromString($ticketNonce)->getBytes())
            ->first();
    }

    public function checkInTicket(Ticket $ticket, int $userId): void
    {
        $ticket->fill([
            'isCheckedIn' => true,
            'checkInTime' => Carbon::now()->toDateTimeString(),
            'checkInUser' => $userId,
        ]);

        $ticket->save();
    }
}
