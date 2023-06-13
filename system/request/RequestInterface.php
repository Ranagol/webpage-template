<?php

namespace System\request;

/**
 * From all current and future request classes we expect two things:
 * 1 - to get all the request data 
 * 2 - to get individual request key - value pair data 
 * 
 * To achieve this, we use this interface. More accuratelly,
 * the AbstractRequest class impletemnts this interface, and since all 
 * other request classes are childs of the AbstractRequest, so they have 
 * to implement it too. This is important, because these two funcions 
 * will be constantly used in the controllers.
 * 
 * Where is this interface used? It is used for type hinting, in UserApiController
 * public static function store(RequestInterface $apiRequest): void for typehinting.
 */
interface RequestInterface
{
    /**
     * Returns all request data.
     *
     * @return array
     */
    public function getAllRequestData(): array;

    /**
     * Returns one specific key-value pair data from the request.
     * 
     * Example when to use this function:
     * in case of 'update', we might need the id of the User that we want to update.
     * 
     * Then, we do this: $id = $request->get('id');
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);
}
