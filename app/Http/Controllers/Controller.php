<?php

namespace App\Http\Controllers;

abstract class Controller
{

    protected function getResponse($status, $message, $data = [])
    {
        return response()->json(
            [
                'status' => $status,
                'message' => $message,
                'data' => $data
            ],
            $status ? 200 : 401
        );
    }
}
