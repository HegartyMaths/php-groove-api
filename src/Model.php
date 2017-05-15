<?php

namespace Groove;

use JsonSerializable;

abstract class Model implements JsonSerializable
{
    /**
     * @var \stdClass
     */
    protected $details;

    /**
     * @var \Groove\Client
     */
    protected $client;

    /**
     * Model.
     *
     * @param \stdClass $details
     * @param \Groove\Client $client
     */
    public function __construct($details, $client)
    {
        $this->details = $details;
        $this->client = $client;
    }

    /**
     * Serialize json.
     *
     * @return \stdClass
     */
    public function jsonSerialize()
    {
        return $this->details;
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
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->details->$key;
    }
}
