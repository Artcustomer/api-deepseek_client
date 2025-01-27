<?php

namespace Artcustomer\DeepSeekClient;

use Artcustomer\ApiUnit\Gateway\AbstractApiGateway;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\DeepSeekClient\Client\ApiClient;
use Artcustomer\DeepSeekClient\Connector\ChatCompletionsConnector;
use Artcustomer\DeepSeekClient\Connector\FIMCompletionsConnector;
use Artcustomer\DeepSeekClient\Connector\ModelConnector;
use Artcustomer\DeepSeekClient\Connector\UserConnector;
use Artcustomer\DeepSeekClient\Utils\ApiInfos;

/**
 * @author David
 */
class DeepSeekApiGateway extends AbstractApiGateway
{

    private ChatCompletionsConnector $chatCompletionsConnector;
    private FIMCompletionsConnector $fimCompletionsConnector;
    private ModelConnector $modelConnector;
    private UserConnector $userConnector;

    private string $apiKey;
    private bool $availability;

    /**
     * Constructor
     *
     * @param string $apiKey
     * @param bool $availability
     * @throws \ReflectionException
     */
    public function __construct(string $apiKey, bool $availability)
    {
        $this->apiKey = $apiKey;
        $this->availability = $availability;

        $this->defineParams();

        parent::__construct(ApiClient::class, [$this->params]);
    }

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->setupConnectors();

        $this->client->initialize();
    }

    /**
     * Test API
     *
     * @return IApiResponse
     */
    public function test(): IApiResponse
    {
        return $this->modelConnector->list();
    }

    /**
     * Get ChatCompletionsConnector instance
     *
     * @return ChatCompletionsConnector
     */
    public function getChatCompletionsConnector(): ChatCompletionsConnector
    {
        return $this->chatCompletionsConnector;
    }

    /**
     * Get FIMCompletionsConnector instance
     *
     * @return FIMCompletionsConnector
     */
    public function getFIMCompletionsConnector(): FIMCompletionsConnector
    {
        return $this->fimCompletionsConnector;
    }

    /**
     * Get ModelConnector instance
     *
     * @return ModelConnector
     */
    public function getModelConnector(): ModelConnector
    {
        return $this->modelConnector;
    }

    /**
     * Get UserConnector instance
     *
     * @return UserConnector
     */
    public function getUserConnector(): UserConnector
    {
        return $this->userConnector;
    }

    /**
     * Setup connectors
     *
     * @return void
     */
    private function setupConnectors(): void
    {
        $this->chatCompletionsConnector = new ChatCompletionsConnector($this->client);
        $this->fimCompletionsConnector = new FIMCompletionsConnector($this->client);
        $this->modelConnector = new ModelConnector($this->client);
        $this->userConnector = new UserConnector($this->client);
    }

    /**
     * Define parameters
     *
     * @return void
     */
    private function defineParams(): void
    {
        $this->params['api_name'] = ApiInfos::API_NAME;
        $this->params['api_version'] = ApiInfos::API_VERSION;
        $this->params['protocol'] = ApiInfos::PROTOCOL;
        $this->params['host'] = ApiInfos::HOST;
        $this->params['version'] = ApiInfos::VERSION;
        $this->params['api_key'] = $this->apiKey;
        $this->params['availability'] = $this->availability;
    }
}