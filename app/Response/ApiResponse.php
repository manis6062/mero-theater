<?php
namespace App\Response;
class ApiResponse
{
    public static function sendResponse($status, $error, $message, $data = null)
    {
        $response['status']  = intval($status);
        $response['error']  = $error;
        $response['message'] = $message;
        if ($data || is_array($data)) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }
}