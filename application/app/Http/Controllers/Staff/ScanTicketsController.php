<?php

namespace App\Http\Controllers\Staff;

use Throwable;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Services\TicketService;
use App\Exceptions\AppException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\JsonResponseTrait;
use Illuminate\Contracts\Support\Renderable;
use App\ThirdParty\CardanoClients\ICardanoClient;

class ScanTicketsController extends Controller
{
    use JsonResponseTrait;

    private EventService $eventService;
    private TicketService $ticketService;
    private ICardanoClient $cardanoClient;

    public function __construct(
        EventService $eventService,
        TicketService $ticketService,
        ICardanoClient $cardanoClient,
    )
    {
        $this->eventService = $eventService;
        $this->ticketService = $ticketService;
        $this->cardanoClient = $cardanoClient;
    }

    public function index(): Renderable
    {
        return view('staff.scan-tickets.index');
    }

    public function ajaxRegisterTicket(Request $request): JsonResponse
    {
        try {

            if (empty($request->eventUUID) || empty($request->qr) || !str_contains($request->qr, '|')) {
                throw new AppException(trans('Invalid request'));
            }

            $event = $this->eventService->findByUUID($request->eventUUID);

            if (!$event) {
                throw new AppException(trans('Event not found'));
            }

            [$assetId, $ticketNonce] = explode('|', $request->qr);

            $ticket = $this->ticketService->findTicketByQRCode($event->id, $assetId, $ticketNonce);

            if (!$ticket) {
                throw new AppException(trans('Invalid ticket'));
            }

            if ($ticket->isCheckedIn) {
                throw new AppException(trans(
                    'Ticket already registered :checkedInAt',
                    [
                        'checkedInAt' => $ticket->checkInTime->diffForHumans(),
                    ]
                ));
            }

            $this->checkAssetHodl($event, $ticket);

            $this->ticketService->checkInTicket($ticket, Auth::id());

            return $this->successResponse([
                'success' => trans('Ticket successfully registered'),
            ]);

        } catch (Throwable $exception) {

            return $this->jsonException(trans('Failed to register ticket'), $exception);

        }
    }

    /**
     * @throws AppException
     */
    private function checkAssetHodl(Event $event, Ticket $ticket): void
    {
        if (!$event->hodlAsset) {
            return;
        }

        if (!$this->cardanoClient->assetHodled($ticket->policyId, $ticket->assetId, $ticket->stakeKey)) {
            throw new AppException(trans('Asset not found in wallet'));
        }
    }
}
