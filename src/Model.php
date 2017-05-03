<?php

namespace Groove;

use Illuminate\Contracts\Support\Jsonable;

abstract class Model implements Jsonable
{
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

    public function __get($key)
    {
        return $this->details->$key;
    }
}
