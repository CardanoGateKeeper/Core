<?php

namespace App\Http\Controllers\API\V1;

use Throwable;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class NonceController extends BaseController
{
    private TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function index(Request $request): JsonResponse
    {
        try {

            $request->validate([
                'policy_id' => ['required'],
                'asset_id' => ['required'],
                'stake_key' => ['required'],
            ]);

            $ticket = $this->ticketService->findExistingTicket(
                $request->policy_id,
                $request->asset_id,
                $request->stake_key,
            );

            if (!$ticket) {
                $ticket = $this->ticketService->createNewTicket(
                    $request->policy_id,
                    $request->asset_id,
                    $request->stake_key,
                );
            }

            return $this->successResponse([
                'nonce' => bin2hex(Uuid::fromBytes($ticket->signatureNonce)->toString())
            ]);

        } catch (Throwable $exception) {

            return $this->apiException($exception);

        }
    }
}
