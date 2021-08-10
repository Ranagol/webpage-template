<?php

namespace System\request;

use System\request\AbstractRequest;

/**
 * The request classes are ment to get the request data. Because that is not the controllers job.
 * They will get the request data as soon as they are created (through the __construct(), 
 * which is actually happening in the child classes). 
 */
abstract class AbstractRequest implements RequestInterface
{
    /**
     * We store all request data here, once the child __construct() is activated.
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
     * Returns individual key - value pair from the request data.
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
