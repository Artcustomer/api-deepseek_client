<?php

namespace Artcustomer\DeepSeekClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\DeepSeekClient\Http\UserRequest;
use Artcustomer\DeepSeekClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class UserConnector extends AbstractConnector
{

    /**
     * Constructor
     *
     * @param AbstractApiClient $client
     */
    public function __construct(AbstractApiClient $client)
    {
        parent::__construct($client, false);
    }

    /**
     * @return IApiResponse
     */
    public function balance(): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET,
            'endpoint' => ApiEndpoints::BALANCE
        ];
        $request = $this->client->getRequestFactory()->instantiate(UserRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}
