<?php

namespace Artcustomer\DeepSeekClient\Client;

use Artcustomer\ApiUnit\Client\CurlApiClient;
use Artcustomer\DeepSeekClient\Factory\Decorator\ResponseDecorator;
use Artcustomer\DeepSeekClient\Http\ApiRequest;
use Artcustomer\DeepSeekClient\Utils\ApiInfos;
use Artcustomer\DeepSeekClient\Utils\ApiTools;

/**
 * @author David
 */
class ApiClient extends CurlApiClient
{

    public const CONFIG_USE_DECORATOR = 'useDecorator';

    /**
     * Constructor
     *
     *  This client is configured to return response as objects.
     *  It helps to manipulate data before encoding items to json format.
     *
     * @param array $params
     * @param array $clientConfig
     */
    public function __construct(array $params, array $clientConfig = [])
    {
        parent::__construct($params, $clientConfig);
    }

    /**
     * Initialize client
     *
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        $this->init();
        $this->checkParams();
    }

    /**
     * @return void
     */
    protected function setupClient(): void
    {
        $useDecorator = $this->clientConfig[self::CONFIG_USE_DECORATOR] ?? false;

        if ($useDecorator) {
            $this->responseDecoratorClassName = ResponseDecorator::class;
            $this->responseDecoratorArguments = [ApiTools::CONTENT_TYPE_OBJECT];
        }
    }

    /**
     * Pre build request
     *
     * @param string $method
     * @param string $endpoint
     * @param array $query
     * @param $body
     * @param array $headers
     * @return void
     */
    protected function preBuildRequest(string $method, string $endpoint, array $query = [], $body = null, array $headers = []): void
    {
        $this->requestClassName = ApiRequest::class;
    }

    /**
     * Check parameters
     *
     * @return void
     * @throws \Exception
     */
    private function checkParams(): void
    {
        $requiredParams = [ApiTools::PARAM_PROTOCOL, ApiTools::PARAM_HOST, ApiTools::PARAM_VERSION];

        if (
            !isset($this->apiParams[ApiTools::PARAM_AVAILABILITY]) ||
            $this->apiParams[ApiTools::PARAM_AVAILABILITY] !== true
        ) {
            throw new \Exception('API is not available', 500);
        }

        foreach ($requiredParams as $param) {
            if (!isset($this->apiParams[$param])) {
                $this->isOperational = false;
            }
        }

        if (!$this->isOperational) {
            throw new \Exception(sprintf('%s : Missing params', ApiInfos::API_NAME), 500);
        }
    }
}
