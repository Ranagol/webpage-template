<?php

namespace System\request;

interface RequestInterface
{
    /**
     * Returns all request data.
     *
     * @return array
     */
    public function getAllRequestData(): array;

    /**
     * Example when to use this function:
     * in case of 'update', we might need the id of the User that we want to update.
     * Then, we do this: $id = $request->get('id');
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);
}
