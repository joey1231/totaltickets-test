<?php
class BaseController
{
    public function errorResponse($error)
    {
        http_response_code(404);
        return json_encode($error);
    }

    public function successResponse($data)
    {
        http_response_code(200);
        return json_encode($data);
    }
}
