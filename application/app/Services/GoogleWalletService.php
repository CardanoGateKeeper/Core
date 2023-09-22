<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Client as Google_Client;
use Google\Service\Exception;

require_once dirname(__FILE__) . '/WalletObjects.php';

class GoogleWalletService {

    public string $keyFilePath;

    public ServiceAccountCredentials $credentials;

    public \Google_Service_Walletobjects $service;

    public function __construct() {
        $this->keyFilePath = storage_path('.google-wallet-config');
        $this->auth();
    }

    public function auth() {
        $scope = 'https://www.googleapis.com/auth/wallet_object.issuer';

        $this->credentials = new ServiceAccountCredentials($scope, $this->keyFilePath);

        // Initialize Google Wallet API service
        $this->client = new Google_Client();
        $this->client->setApplicationName('APPLICATION_NAME');
        $this->client->setScopes($scope);
        $this->client->setAuthConfig($this->keyFilePath);

        $this->service = new \Google_Service_Walletobjects($this->client);
    }

    /**
     * Create an object.
     *
     * @param string $issuerId     The issuer ID being used for this request.
     * @param string $classSuffix  Developer-defined unique ID for this pass class.
     * @param string $objectSuffix Developer-defined unique ID for this pass object.
     *
     * @return string The pass object ID: "{$issuerId}.{$objectSuffix}"
     */
    public function createObject(string $issuerId, string $classSuffix, string $objectSuffix) {

        // Check if the object exists
        try {
            $this->service->genericobject->get("{$issuerId}.{$objectSuffix}");

//            print("Object {$issuerId}.{$objectSuffix} already exists!");

            return "{$issuerId}.{$objectSuffix}";
        } catch (Exception $ex) {
//            dd($ex);
            if (empty($ex->getErrors()) || $ex->getErrors()[0]['reason'] != 'resourceNotFound') {
                // Something else went wrong...
                dd("Oops! Couldn't find the things?");
                dd($ex);
                print_r($ex);

                return "{$issuerId}.{$objectSuffix}";
            }
        }

        // See link below for more information on required properties
        // https://developers.google.com/wallet/generic/rest/v1/genericobject
        try {
            $newObject = new \Google_Service_Walletobjects_GenericObject([
                'id'                 => "{$issuerId}.{$objectSuffix}",
                'classId'            => "{$issuerId}.{$classSuffix}",
                'state'              => 'ACTIVE',
                'genericType'        => 'GENERIC_ENTRY_TICKET',
                'cardTitle'          => new \Google_Service_Walletobjects_LocalizedString([
                    'defaultValue' => new \Google_Service_Walletobjects_TranslatedString([
                        'language' => 'en-US',
                        'value'    => 'NFTxLV',
                    ]),
                ]),
                'header'             => new \Google_Service_Walletobjects_LocalizedString([
                    'defaultValue' => new \Google_Service_Walletobjects_TranslatedString([
                        'language' => 'en-US',
                        'value'    => 'After Party',
                    ]),
                ]),
                'subheader'          => new \Google_Service_Walletobjects_LocalizedString([
                    'defaultValue' => new \Google_Service_Walletobjects_TranslatedString([
                        'language' => 'en-US',
                        'value'    => 'Las Vegas Convention Center',
                    ]),
                ]),
                'logo'               => new \Google_Service_Walletobjects_Image([
                    'sourceUri'          => new \Google_Service_Walletobjects_ImageUri([
                        'uri' => 'https://nftxlv.com/wp-content/uploads/2023/09/Xcolored-black-bg-icon.png',
                    ]),
                    'contentDescription' => new \Google_Service_Walletobjects_LocalizedString([
                        'defaultValue' => new \Google_Service_Walletobjects_TranslatedString([
                            'language' => 'en-US',
                            'value'    => 'NFTxLV',
                        ]),
                    ]),
                ]),
                'hexBackgroundColor' => '#131313',
                'notifications'      => new \Google_Service_Walletobjects_Notifications([
                    'upcomingNotification' => new \Google_Service_Walletobjects_UpcomingNotification([
                        'enableNotification' => true,
                    ]),
                ]),
                'barcode'            => new \Google_Service_Walletobjects_Barcode([
                    'type'  => 'QR_CODE',
                    'value' => '44455630313631|a8991fff-4a59-4a8d-9f06-9c39e142955b',
                ]),
                'heroImage'          => new \Google_Service_Walletobjects_Image([
                    'sourceUri'          => new \Google_Service_Walletobjects_ImageUri([
                        'uri' => 'https://nftxlv.com/wp-content/uploads/2023/05/OG.jpg',
                    ]),
                    'contentDescription' => new \Google_Service_Walletobjects_LocalizedString([
                        'defaultValue' => new \Google_Service_Walletobjects_TranslatedString([
                            'language' => 'en-US',
                            'value'    => 'NFTxLV 2023',
                        ]),
                    ]),
                ]),
                'validTimeInterval'  => new \Google_Service_Walletobjects_TimeInterval([
                    'start' => new \Google_Service_Walletobjects_DateTime([
                        'date' => date(DATE_ATOM, strtotime('2023-09-29 23:00:00 UTC')),
                    ]),
                    'end'   => new \Google_Service_Walletobjects_DateTime([
                        'date' => date(DATE_ATOM, strtotime('2023-10-01 11:00:00 UTC')),
                    ]),
                ]),

                'textModulesData' => [
                    new \Google_Service_Walletobjects_TextModuleData([
                        'header' => 'Friday, September 29th, 2023 - 11:00 PM',
                        'body'   => 'Las Vegas Convention Center',
                        //                        'id'     => 'TEXT_MODULE_ID',
                    ]),
                ],
                'linksModuleData' => new \Google_Service_Walletobjects_LinksModuleData([
                    'uris' => [
                        new \Google_Service_Walletobjects_Uri([
                            'uri'         => 'https://nftxlv.com',
                            'description' => 'Visit our website!',
                            //                            'id'          => 'LINK_MODULE_URI_ID',
                        ]),
                        new \Google_Service_Walletobjects_Uri([
                            'uri'         => 'https://twitter.com/nftxlv',
                            'description' => 'Follow us on X (Formerly Twitter)!',
                        ]),

                    ],
                ]),
            ]);

            $response = $this->service->genericobject->insert($newObject);

            return $response;
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    /**
     * Generate a signed JWT that creates a new pass class and object.
     * When the user opens the "Add to Google Wallet" URL and saves the pass to
     * their wallet, the pass class and object defined in the JWT are
     * created. This allows you to create multiple pass classes and objects in
     * one API call when the user saves the pass to their wallet.
     *
     * @param string $issuerId     The issuer ID being used for this request.
     * @param string $classSuffix  Developer-defined unique ID for the pass class.
     * @param string $objectSuffix Developer-defined unique ID for the pass object.
     *
     * @return string An "Add to Google Wallet" link.
     */
    public function createJwtNewObjects(string $issuerId, string $classSuffix, string $objectSuffix) {
        // See link below for more information on required properties
        // https://developers.google.com/wallet/generic/rest/v1/genericclass
        $newClass = new \Google_Service_Walletobjects_GenericClass([
            'id' => "{$issuerId}.{$classSuffix}",
        ]);

        // See link below for more information on required properties
        // https://developers.google.com/wallet/generic/rest/v1/genericobject
        $newObject = new \Google_Service_Walletobjects_GenericObject([
            'id'      => "{$issuerId}.{$objectSuffix}",
            'classId' => "{$issuerId}.{$classSuffix}",
            'state'   => 'ACTIVE',
        ]);

        // The service account credentials are used to sign the JWT
        $serviceAccount = json_decode(file_get_contents($this->keyFilePath), true);

        // Create the JWT as an array of key/value pairs
        $claims = [
            'iss'     => $serviceAccount['client_email'],
            'aud'     => 'google',
            'origins' => [
                'https://alpha.gatekeeper.rocks',
                'https://10.1.1.11:8020',
                'https://127.0.0.1',
            ],
            'typ'     => 'savetowallet',
            'payload' => [
                'genericClasses' => [
                    $newClass,
                ],
                'genericObjects' => [
                    $newObject,
                ],
            ],
        ];

        $token = JWT::encode($claims, $serviceAccount['private_key'], 'RS256');

//        print "Add to Google Wallet link\n";
//        print "https://pay.google.com/gp/v/save/{$token}";

        return $token;
    }
}
