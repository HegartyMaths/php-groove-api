<?php

namespace Groove;

use Groove\Api\Agent;
use Groove\Api\Group;
use Groove\Api\Ticket;
use Groove\Api\Mailbox;
use Groove\Api\Customer;
use Groove\Api\Attachment;
use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * @var string
     */
    const VERSION = 'v0.3.0';

    /**
     * @var string
     */
    const GROOVE_API_VERSION = 'v1';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * Groove client.
     *
     * @param string $accessToken
     * @param \GuzzleHttp\Client $httpClient
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
     * @param  array $params
     * @return mixed
     */
    public function get($endpoint, $params = [])
    {
        $request = $this->httpClient->get($endpoint, ['form_params' => $params]);

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
     * Put request.
     *
     * @param  string $endpoint
     * @param  array $params
     * @return mixed
     */
    public function put($endpoint, $params = [])
    {
        $request = $this->httpClient->put($endpoint, ['form_params' => $params]);

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
     * Groove attachments.
     *
     * @return Attachment
     */
    public function attachments()
    {
        return new Attachment($this);
    }

    /**
     * Groove groups.
     *
     * @return Group
     */
    public function groups()
    {
        return new Group($this);
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
     * @param  string $accessToken
     * @return void
     */
    private function setupHttpClient($accessToken)
    {
        $this->httpClient = new HttpClient([
            'base_uri' => 'https://api.groovehq.com/'.self::GROOVE_API_VERSION.'/',
            'headers' => [
                'Authorization' => "Bearer $accessToken",
            ],
        ]);
    }
}
