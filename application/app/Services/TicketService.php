<?php

namespace App\Services;

use App\Models\Ticket;
use Ramsey\Uuid\Uuid;

class TicketService
{
    public function findExistingTicket(string $policyId, string $assetId, string $stakeKey): ?Ticket
    {
        return Ticket::where('policyId', $policyId)
            ->where('assetId', $assetId)
            ->where('stakeKey', $stakeKey)
            ->first();
    }

    public function createNewTicket(string $policyId, string $assetId, string $stakeKey): Ticket
    {
        $ticket = new Ticket;

        $ticket->fill([
            'policyId' => $policyId,
            'assetId' => $assetId,
            'stakeKey' => $stakeKey,
            'signatureNonce' => Uuid::uuid4()->getBytes(),
        ]);

        $ticket->save();

        return $ticket;
    }

    public function updateTicket(Ticket $ticket, string $signature): void
    {
        $ticket->update([
            'ticketNonce' => Uuid::uuid4()->getBytes(),
        ]);
    }
}
