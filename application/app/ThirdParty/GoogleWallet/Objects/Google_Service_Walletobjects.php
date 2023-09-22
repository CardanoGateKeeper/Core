<?php

namespace App\ThirdParty\GoogleWallet\Objects;

use Google\Service as Google_Service;

class Google_Service_Walletobjects extends Google_Service {

    /** Private Service: https://www.googleapis.com/auth/wallet_object.issuer. */
    const WALLET_OBJECT_ISSUER = "https://www.googleapis.com/auth/wallet_object.issuer";

    public $eventticketclass;
    public $eventticketobject;
    public $flightclass;
    public $flightobject;
    public $genericclass;
    public $genericobject;
    public $giftcardclass;
    public $giftcardobject;
    public $issuer;
    public $jwt;
    public $loyaltyclass;
    public $loyaltyobject;
    public $media;
    public $offerclass;
    public $offerobject;
    public $permissions;
    public $smarttap;
    public $transitclass;
    public $transitobject;
    public $walletobjects_v1_privateContent;

    /**
     * Constructs the internal representation of the Walletobjects service.
     *
     * @param Google_Client $client
     */
    public function __construct(Google_Client $client) {
        parent::__construct($client);
        $this->rootUrl     = 'https://walletobjects.googleapis.com/';
        $this->servicePath = '';
        $this->batchPath   = 'batch';
        $this->version     = 'v1';
        $this->serviceName = 'walletobjects';

        $this->eventticketclass                = new Google_Service_Walletobjects_Eventticketclass_Resource($this,
            $this->serviceName, 'eventticketclass', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/eventTicketClass/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/eventTicketClass/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/eventTicketClass',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/eventTicketClass',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'issuerId'   => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/eventTicketClass/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/eventTicketClass/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->eventticketobject               = new Google_Service_Walletobjects_Eventticketobject_Resource($this,
            $this->serviceName, 'eventticketobject', [
                'methods' => [
                    'addmessage'               => [
                        'path'       => 'walletobjects/v1/eventTicketObject/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'                      => [
                        'path'       => 'walletobjects/v1/eventTicketObject/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'                   => [
                        'path'       => 'walletobjects/v1/eventTicketObject',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'                     => [
                        'path'       => 'walletobjects/v1/eventTicketObject',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'classId'    => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'modifylinkedofferobjects' => [
                        'path'       => 'walletobjects/v1/eventTicketObject/{resourceId}/modifyLinkedOfferObjects',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'patch'                    => [
                        'path'       => 'walletobjects/v1/eventTicketObject/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'                   => [
                        'path'       => 'walletobjects/v1/eventTicketObject/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->flightclass                     = new Google_Service_Walletobjects_Flightclass_Resource($this,
            $this->serviceName, 'flightclass', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/flightClass/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/flightClass/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/flightClass',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/flightClass',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'issuerId'   => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/flightClass/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/flightClass/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->flightobject                    = new Google_Service_Walletobjects_Flightobject_Resource($this,
            $this->serviceName, 'flightobject', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/flightObject/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/flightObject/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/flightObject',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/flightObject',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'classId'    => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/flightObject/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/flightObject/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->genericclass                    = new Google_Service_Walletobjects_Genericclass_Resource($this,
            $this->serviceName, 'genericclass', [
                'methods' => [
                    'get'    => [
                        'path'       => 'walletobjects/v1/genericClass/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert' => [
                        'path'       => 'walletobjects/v1/genericClass',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'   => [
                        'path'       => 'walletobjects/v1/genericClass',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'issuerId'   => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'  => [
                        'path'       => 'walletobjects/v1/genericClass/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update' => [
                        'path'       => 'walletobjects/v1/genericClass/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->genericobject                   = new Google_Service_Walletobjects_Genericobject_Resource($this,
            $this->serviceName, 'genericobject', [
                'methods' => [
                    'get'    => [
                        'path'       => 'walletobjects/v1/genericObject/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert' => [
                        'path'       => 'walletobjects/v1/genericObject',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'   => [
                        'path'       => 'walletobjects/v1/genericObject',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'classId'    => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'  => [
                        'path'       => 'walletobjects/v1/genericObject/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update' => [
                        'path'       => 'walletobjects/v1/genericObject/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->giftcardclass                   = new Google_Service_Walletobjects_Giftcardclass_Resource($this,
            $this->serviceName, 'giftcardclass', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/giftCardClass/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/giftCardClass/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/giftCardClass',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/giftCardClass',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'issuerId'   => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/giftCardClass/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/giftCardClass/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->giftcardobject                  = new Google_Service_Walletobjects_Giftcardobject_Resource($this,
            $this->serviceName, 'giftcardobject', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/giftCardObject/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/giftCardObject/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/giftCardObject',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/giftCardObject',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'classId'    => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/giftCardObject/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/giftCardObject/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->issuer                          = new Google_Service_Walletobjects_Issuer_Resource($this,
            $this->serviceName, 'issuer', [
                'methods' => [
                    'get'    => [
                        'path'       => 'walletobjects/v1/issuer/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert' => [
                        'path'       => 'walletobjects/v1/issuer',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'   => [
                        'path'       => 'walletobjects/v1/issuer',
                        'httpMethod' => 'GET',
                        'parameters' => [],
                    ],
                    'patch'  => [
                        'path'       => 'walletobjects/v1/issuer/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update' => [
                        'path'       => 'walletobjects/v1/issuer/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->jwt                             = new Google_Service_Walletobjects_Jwt_Resource($this,
            $this->serviceName, 'jwt', [
                'methods' => [
                    'insert' => [
                        'path'       => 'walletobjects/v1/jwt',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                ],
            ]);
        $this->loyaltyclass                    = new Google_Service_Walletobjects_Loyaltyclass_Resource($this,
            $this->serviceName, 'loyaltyclass', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/loyaltyClass/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/loyaltyClass/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/loyaltyClass',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/loyaltyClass',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'issuerId'   => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/loyaltyClass/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/loyaltyClass/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->loyaltyobject                   = new Google_Service_Walletobjects_Loyaltyobject_Resource($this,
            $this->serviceName, 'loyaltyobject', [
                'methods' => [
                    'addmessage'               => [
                        'path'       => 'walletobjects/v1/loyaltyObject/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'                      => [
                        'path'       => 'walletobjects/v1/loyaltyObject/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'                   => [
                        'path'       => 'walletobjects/v1/loyaltyObject',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'                     => [
                        'path'       => 'walletobjects/v1/loyaltyObject',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'classId'    => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'modifylinkedofferobjects' => [
                        'path'       => 'walletobjects/v1/loyaltyObject/{resourceId}/modifyLinkedOfferObjects',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'patch'                    => [
                        'path'       => 'walletobjects/v1/loyaltyObject/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'                   => [
                        'path'       => 'walletobjects/v1/loyaltyObject/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->media                           = new Google_Service_Walletobjects_Media_Resource($this,
            $this->serviceName, 'media', [
                'methods' => [
                    'upload' => [
                        'path'       => 'walletobjects/v1/privateContent/{issuerId}/uploadPrivateImage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'issuerId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->offerclass                      = new Google_Service_Walletobjects_Offerclass_Resource($this,
            $this->serviceName, 'offerclass', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/offerClass/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/offerClass/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/offerClass',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/offerClass',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'issuerId'   => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/offerClass/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/offerClass/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->offerobject                     = new Google_Service_Walletobjects_Offerobject_Resource($this,
            $this->serviceName, 'offerobject', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/offerObject/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/offerObject/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/offerObject',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/offerObject',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'classId'    => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/offerObject/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/offerObject/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->permissions                     = new Google_Service_Walletobjects_Permissions_Resource($this,
            $this->serviceName, 'permissions', [
                'methods' => [
                    'get'    => [
                        'path'       => 'walletobjects/v1/permissions/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update' => [
                        'path'       => 'walletobjects/v1/permissions/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->smarttap                        = new Google_Service_Walletobjects_Smarttap_Resource($this,
            $this->serviceName, 'smarttap', [
                'methods' => [
                    'insert' => [
                        'path'       => 'walletobjects/v1/smartTap',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                ],
            ]);
        $this->transitclass                    = new Google_Service_Walletobjects_Transitclass_Resource($this,
            $this->serviceName, 'transitclass', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/transitClass/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/transitClass/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/transitClass',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/transitClass',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'issuerId'   => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/transitClass/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/transitClass/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->transitobject                   = new Google_Service_Walletobjects_Transitobject_Resource($this,
            $this->serviceName, 'transitobject', [
                'methods' => [
                    'addmessage' => [
                        'path'       => 'walletobjects/v1/transitObject/{resourceId}/addMessage',
                        'httpMethod' => 'POST',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'get'        => [
                        'path'       => 'walletobjects/v1/transitObject/{resourceId}',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'insert'     => [
                        'path'       => 'walletobjects/v1/transitObject',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                    'list'       => [
                        'path'       => 'walletobjects/v1/transitObject',
                        'httpMethod' => 'GET',
                        'parameters' => [
                            'classId'    => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'token'      => [
                                'location' => 'query',
                                'type'     => 'string',
                            ],
                            'maxResults' => [
                                'location' => 'query',
                                'type'     => 'integer',
                            ],
                        ],
                    ],
                    'patch'      => [
                        'path'       => 'walletobjects/v1/transitObject/{resourceId}',
                        'httpMethod' => 'PATCH',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                    'update'     => [
                        'path'       => 'walletobjects/v1/transitObject/{resourceId}',
                        'httpMethod' => 'PUT',
                        'parameters' => [
                            'resourceId' => [
                                'location' => 'path',
                                'type'     => 'string',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
            ]);
        $this->walletobjects_v1_privateContent = new Google_Service_Walletobjects_WalletobjectsV1PrivateContent_Resource($this,
            $this->serviceName, 'privateContent', [
                'methods' => [
                    'uploadPrivateData' => [
                        'path'       => 'walletobjects/v1/privateContent/uploadPrivateData',
                        'httpMethod' => 'POST',
                        'parameters' => [],
                    ],
                ],
            ]);
    }
}
