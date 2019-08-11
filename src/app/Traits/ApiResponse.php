<?php

namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait ApiResponse
{
    public function checkForErrors(Request $request, $params = [])
    {
        $validator = Validator::make(
            $request->all(),
            $params
        );

        if($validator->fails())
        {
            return response()
                ->json([
                    'errors' => $validator->errors()->all(),
                    'status' => 412,
                ], 412);
        }
    }
}