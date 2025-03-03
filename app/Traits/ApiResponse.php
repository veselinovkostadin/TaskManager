<?php

namespace App\Traits;

trait ApiResponse
{

    protected function returnData($data, $message = "", $code = 200)
    {
        return response()->json(
            [
                "data" => $data,
                "message" => $message,
                "code" => $code
            ]
        );
    }
}
