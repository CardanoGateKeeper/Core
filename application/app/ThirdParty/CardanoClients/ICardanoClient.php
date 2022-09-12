<?php

namespace App\ThirdParty\CardanoClients;

use App\Exceptions\AppException;

interface ICardanoClient
{
    public const HTTP_REQUEST_GET = 'GET';
    public const HTTP_REQUEST_POST = 'POST';

    public function getAssetMetadata(string $assetId): ?array;
}
