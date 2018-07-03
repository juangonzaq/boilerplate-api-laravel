<?php
namespace App\Http\Common\Responses;
use App\Http\Controllers\Controller;

abstract class ResponseBase extends Controller
{
    public function sendResponse($result, $message = '', $status = true)
    {
        if(!$status){
            $message = $this->setMessage($result);
        }
        $response = [
            'success' => $status,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
    private function setMessage($result){
        if(is_null($result) or (is_array($result) and count($result) == 0)){
            switch (request()->method()){
                case 'PUT':
                    $message = 'Could not update';
                    break;
                case 'DELETE':
                    $message = 'Could not deleted';
                    break;
                case 'POST':
                    $message = 'Could not save';
                    break;
                case 'GET':
                    $message = 'Could not get';
                    break;
            }
            return $message;
        }
    }

    public function sendResponseCreated($result, $message = '')
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 201);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}