<?php

namespace app\System;

abstract class AbstractRequest
{
    /**
     * We store all request data here
     */
    protected array $requestData;

    /**
     * Returns all request data.
     *
     * @return array
     */
    public function getAllRequestData(): array
    {
        return $this->requestData;
    }

    /**
     * Example when to use this function: 
     * in case of 'update', we might need the id of the User that we want to update.
     * Then, we do this: $id = $request->get('id');
     *
     * @param string $key
     */
    public function get(string $key)
    {
        return $this->requestData[$key];
    }
}
