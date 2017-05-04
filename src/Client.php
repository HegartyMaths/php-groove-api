<?php

namespace Groove;

use Groove\Api\Agent;
use Groove\Api\Mailbox;
use Groove\Api\Ticket;
use Groove\Api\Customer;
use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var null
     */
    private $httpClient;

    /**
     * Groove client.
     *
     * @param string $accessToken
     * @param null $httpClient
     */
    public function __construct($accessToken, $httpClient = null)
    {
        $this->accessToken = $accessToken;
        $this->httpClient = $httpClient;

        if (is_null($httpClient)) {
            $this->setupHttpClient($accessToken);
        }
    }

    /**
     * Get request.
     *
     * @param  string $endpoint
     * @return mixed
     */
    public function get($endpoint)
    {
        $request = $this->httpClient->get($endpoint);

        return json_decode($request->getBody());
    }

    /**
     * Post request.
     *
     * @param  string $endpoint
     * @param  array $params
     * @return mixed
     */
    public function post($endpoint, $params = [])
    {
        $request = $this->httpClient->post($endpoint, ['form_params' => $params]);

        return json_decode($request->getBody());
    }

    /**
     * Groove agents.
     *
     * @return Agent
     */
    public function agents()
    {
        return new Agent($this);
    }

    /**
     * Groove tickets.
     *
     * @return Ticket
     */
    public function tickets()
    {
        return new Ticket($this);
    }

    /**
     * Groove customers.
     *
     * @return Customer
     */
    public function customers()
    {
        return new Customer($this);
    }

    /**
     * Groove mailboxes.
     *
     * @return Mailbox
     */
    public function mailboxes()
    {
        return new Mailbox($this);
    }

    /**
     * Get access token.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set access token.
     *
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Set up the HTTP client.
     *
     * @param  $accessToken
     * @return void
     */
    private function setupHttpClient($accessToken)
    {
        $this->httpClient = new HttpClient([
            'base_uri' => 'https://api.groovehq.com/v1/',
            'headers' => [
                'Authorization' => "Bearer $accessToken",
            ],
        ]);
    }
}
