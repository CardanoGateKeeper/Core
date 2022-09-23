<?php

namespace App\ThirdParty\CardanoClients;

interface ICardanoClient
{
    public const HTTP_REQUEST_GET = 'GET';
    public const HTTP_REQUEST_POST = 'POST';

    public function getAssetMetadata(string $assetId): ?array;

    public function assetHodled(string $policyId, string $assetId, string $stakeKey): bool;
}
