<?php

namespace App\Http\Controllers\API\V1;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;
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

            $cacheKey = 'asset-info:' . $request->asset_id;
            $assetInfo = Cache::remember($cacheKey, CACHE_ONE_DAY, function() use($request) {
                return $this->cardanoClient->getAssetMetadata($request->asset_id);
            });

            return $assetInfo
                ? $this->successResponse($assetInfo)
                : $this->errorResponse(trans('asset not found'), Response::HTTP_NOT_FOUND);

        } catch (Throwable $exception) {

            return $this->apiException($exception);

        }
    }
}