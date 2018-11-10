<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($data = [])
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    protected function fail($data = [])
    {
        return response()->json([
            'status' => 'fail',
            'data' => $data,
        ]);
    }

    protected function error($message, $code = 0, $data = [])
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'code' => $code,
            'data' => $data
        ]);
    }

}
