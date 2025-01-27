<?php

namespace Artcustomer\DeepSeekClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\DeepSeekClient\Http\ModelRequest;

/**
 * @author David
 */
class ModelConnector extends AbstractConnector
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
    public function list(): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET
        ];
        $request = $this->client->getRequestFactory()->instantiate(ModelRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}
