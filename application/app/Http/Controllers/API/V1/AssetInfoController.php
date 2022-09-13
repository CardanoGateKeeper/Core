<?php

namespace App\Http\Controllers\API\V1;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\ThirdParty\CardanoClients\ICardanoClient;

class AssetInfoController extends BaseController
{
    private ICardanoClient $cardanoClient;

    public function __construct(ICardanoClient $cardanoClient)
    {
        $this->cardanoClient = $cardanoClient;
    }

    public function index(Request $request): JsonResponse
    {
        try {

            $request->validate([
                'asset_id' => ['required'],
            ]);

            return $this->successResponse(
                $this->cardanoClient->getAssetMetadata($request->asset_id)
            );

        } catch (Throwable $exception) {

            return $this->apiException($exception);

        }
    }
}
