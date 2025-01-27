<?php

namespace Artcustomer\DeepSeekClient\Http;

use Artcustomer\DeepSeekClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class FIMCompletionsRequest extends ApiRequest
{

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct();

        $this->initParams();
        $this->hydrate($data);
        $this->extendParams();
    }

    /**
     * Build Uri
     *
     * @return void
     */
    protected function buildUri(): void
    {
        $this->uri = sprintf('%s/%s/%s', $this->uriBase, ApiEndpoints::BETA, ApiEndpoints::COMPLETIONS);
    }

    /**
     * Build base Uri
     *
     * @return void
     */
    protected function buildUriBase(): void
    {
        $this->uriBase = sprintf('%s%s', $this->protocol, $this->host);
    }

    /**
     * Init parameters
     *
     * @return void
     */
    private function initParams(): void
    {
        $this->body = $this->body ?? [];
    }

    /**
     * Extend parameters
     *
     * @return void
     */
    private function extendParams(): void
    {

    }
}
