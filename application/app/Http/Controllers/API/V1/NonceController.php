<?php

namespace App\Http\Controllers\API\V1;

use Exception;
use Throwable;
use Ramsey\Uuid\Uuid;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Services\TicketService;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Color\Color;
use Illuminate\Http\JsonResponse;
use Endroid\QrCode\Writer\PngWriter;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Encoding\Encoding;
use App\Http\Traits\JsonResponseTrait;
use Endroid\QrCode\Label\Font\NotoSans;
use Symfony\Component\HttpFoundation\Response;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeEnlarge;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class NonceController extends Controller
{
    use JsonResponseTrait;

    private EventService $eventService;
    private TicketService $ticketService;

    public function __construct(
        EventService $eventService,
        TicketService $ticketService
    )
    {
        $this->eventService = $eventService;
        $this->ticketService = $ticketService;
    }

    public function generateNonce(Request $request): JsonResponse
    {
        try {

            $request->validate([
                'event_uuid' => ['required', 'uuid'],
                'policy_id' => ['required', 'string'],
                'asset_id' => ['required', 'string'],
                'stake_key' => ['required', 'string'],
            ]);

            $event = $this->eventService->findByUUID($request->event_uuid);

            if (!$event) {
                return $this->errorResponse(trans('event not found'), Response::HTTP_NOT_FOUND);
            }

            $ticket = $this->ticketService->findExistingTicket(
                $event->id,
                $request->policy_id,
                $request->asset_id,
                $request->stake_key,
            );

            if (!$ticket) {
                $ticket = $this->ticketService->createNewTicket(
                    $event->id,
                    $request->policy_id,
                    $request->asset_id,
                    $request->stake_key,
                );
            }

            return $this->successResponse([
                'nonce' => bin2hex(Uuid::fromBytes($ticket->signatureNonce)->toString())
            ]);

        } catch (Throwable $exception) {

            return $this->jsonException(trans('Failed to generate nonce'), $exception);

        }
    }

    public function validateNonce(Request $request): JsonResponse
    {
        try {

            $request->validate([
                'event_uuid' => ['required', 'uuid'],
                'policy_id'  => ['required', 'string'],
                'asset_id'   => ['required', 'string'],
                'stake_key'  => ['required', 'string'],
                'signature'  => ['required', 'string'],
                'key'        => ['required', 'string'],
            ]);

            $event = $this->eventService->findByUUID($request->event_uuid);

            if (!$event) {
                return $this->errorResponse(trans('event not found'), Response::HTTP_NOT_FOUND);
            }

            $ticket = $this->ticketService->findExistingTicket(
                $event->id,
                $request->policy_id,
                $request->asset_id,
                $request->stake_key,
            );

            if (!$ticket) {
                return $this->errorResponse(trans('ticket not found'), Response::HTTP_NOT_FOUND);
            }

            if (!$this->validSignature($request->signature, $request->key, $ticket->signatureNonce, $ticket->stakeKey)) {
                return $this->errorResponse(trans('invalid signature'), Response::HTTP_BAD_REQUEST);
            }

            if (empty($ticket->ticketNonce)) {
                $this->ticketService->setTicketNonceAndSignature($ticket, $request->signature);
            }

            $qrValue = implode('|', [
                $ticket->assetId,
                Uuid::fromBytes($ticket->ticketNonce)->toString(),
            ]);

            return $this->successResponse([
                'assetId' => $ticket->assetId,
                'securityCode' => Uuid::fromBytes($ticket->ticketNonce)->toString(),
                'qr' => $this->generateQRCode($ticket->assetId, $qrValue),
            ]);

        } catch (Throwable $exception) {

            return $this->jsonException(trans('Failed to validate nonce'), $exception);

        }
    }

    private function validSignature(string $signature, string $key, string $signatureNonce, string $stakeKey): bool
    {
        return trim(shell_exec(sprintf(
            'node %s %s %s %s %s',
            resource_path('nodejs/validateNonce.js'),
            $signature,
            $key,
            bin2hex(Uuid::fromBytes($signatureNonce)->toString()),
                $stakeKey
        ))) === 'true';
    }

    /**
     * @throws Exception
     */
    private function generateQRCode(string $assetId, string $qrValue): string
    {
        $qrCode = QrCode::create($qrValue)
            ->setEncoding(new Encoding('ISO-8859-1'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->setSize(512)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeEnlarge())
            ->setForegroundColor(new Color(0, 0, 0));

        $label = Label::create(hex2bin($assetId))
            ->setFont(new NotoSans(20))
            ->setTextColor(new Color(0, 0, 0));

        return (new PngWriter())
            ->write($qrCode, null, $label)
            ->getDataUri();
    }
}
