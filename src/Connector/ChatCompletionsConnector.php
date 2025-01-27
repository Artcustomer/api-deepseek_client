<?php

namespace Artcustomer\DeepSeekClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\DeepSeekClient\Http\ChatCompletionsRequest;

/**
 * @author David
 */
class ChatCompletionsConnector extends AbstractConnector
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
     * @param array $params
     * @return IApiResponse
     */
    public function create(array $params): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'body' => $params
        ];
        $request = $this->client->getRequestFactory()->instantiate(ChatCompletionsRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}
