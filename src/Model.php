<?php

namespace Groove;

use Illuminate\Contracts\Support\Jsonable;

abstract class Model implements Jsonable
{
    /**
     * @var
     */
    protected $details;

    /**
     * @var \Groove\Client
     */
    protected $client;

    /**
     * Agent.
     *
     * @param $details
     * @param \Groove\Client $client
     */
    public function __construct($details, $client)
    {
        $this->details = $details;
        $this->client = $client;
    }

    /**
     * To JSON.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->details);
    }

    /**
     * To string.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->details);
    }

    /**
     * Get property.
     *
     * @param  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->details->$key;
    }
}
