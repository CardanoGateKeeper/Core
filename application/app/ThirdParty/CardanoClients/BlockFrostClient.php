<?php

namespace App\ThirdParty\CardanoClients;

use App\Exceptions\AppException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BlockFrostClient implements ICardanoClient
{
    /**
     * @throws AppException
     * @throws \JsonException
     */
    public function getAssetMetadata(string $assetId): ?array
    {
        return $this->call(
            self::HTTP_REQUEST_GET,
            "assets/{$assetId}"
        );
    }

    /**
     * @throws AppException
     * @throws \JsonException
     */
    private function get(string $requestUri, array $headers = []): ?array
    {
        return $this->call(self::HTTP_REQUEST_GET, $requestUri, null, $headers);
    }

    /**
     * @throws AppException
     * @throws \JsonException
     */
    private function post(string $requestUri, string $payload, array $headers = []): ?array
    {
        return $this->call(self::HTTP_REQUEST_POST, $requestUri, $payload, $headers);
    }

    /**
     * @throws AppException
     * @throws \JsonException
     */
    private function call(string $requestMethod, string $requestUri, string $payload = null, array $headers = []): ?array
    {
        $curl = curl_init();
        $options = [
            CURLOPT_URL => $this->buildEndpoint($requestUri),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $requestMethod,
            CURLOPT_HTTPHEADER => array_merge(
                [
                    'project_id: ' . getenv('BLOCKFROST_PROJECT_ID')
                ],
                $headers
            ),
        ];
        if ($requestMethod === self::HTTP_REQUEST_POST) {
            $options[CURLOPT_POSTFIELDS] = $payload;
        }
        curl_setopt_array($curl, $options);
        $response = json_decode(curl_exec($curl), true, 512, JSON_THROW_ON_ERROR);
        curl_close($curl);

        if (isset($response['error']) && (int) $response['status_code'] !== Response::HTTP_NOT_FOUND) {
            $error = trans('BlockFrost api error');

            Log::error($error, [
                'request_method' => $requestMethod,
                'request_uri' => $requestUri,
                'status_code' => $response['status_code'] ?? -1,
                'api_error' => $response['error'] ?? 'unknown',
                'api_message' => $response['message'] ?? 'unknown',
            ]);

            throw new AppException($error);
        }

        if (isset($response['status_code']) && $response['status_code'] === Response::HTTP_NOT_FOUND) {
            return null;
        }

        return $response;
    }

    private function buildEndpoint(string $requestUri): string
    {
        return sprintf(
            'https://cardano-%s.blockfrost.io/api/v0/%s',
            env('CARDANO_NETWORK'),
            $requestUri
        );
    }
}
