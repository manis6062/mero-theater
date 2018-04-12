<?php

namespace App\Http\Controllers\API\V1;

use App\CrmModel;
use App\Http\Controllers\Controller;
use App\Response\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createUniqueApiToken()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomtoken = str_shuffle($characters);
        $check = CrmModel::where('api_token', $randomtoken)->count();
        if ($check > 0) {
            $this->createUniqueApiToken();
        } else {
            return $randomtoken;
        }
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:user_tbl',
            'mobile' => 'required|unique:user_tbl|digits:10',
            'password' => 'required|min:8',
        ]);

        if ($validation->fails()) {
            $returnData['status'] = 200;
            $returnData['error'] = true;
            $returnData['message'] = $validation->errors()->first();
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }

        $dataToStore['name'] = $request->fullname;
        $dataToStore['email'] = $request->email;
        $dataToStore['mobile'] = $request->mobile;
        $dataToStore['password'] = bcrypt($request->password);
        $dataToStore['registered_type'] = 'API';
        $dataToStore['suspend'] = 'No';
        $dataToStore['api_token'] = $this->createUniqueApiToken();


        try {
            $result = CrmModel::create($dataToStore);
            $returnData['status'] = 200;
            $returnData['error'] = false;
            $returnData['message'] = 'User Registered Successfully';
            $returnData['data'] = $dataToStore;
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message'], $returnData['data']);
        }catch (\Exception $e)
        {
            $returnData['status'] = 500;
            $returnData['error'] = true;
            $returnData['message'] = $e->getMessage();
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }

    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            $returnData['status'] = 200;
            $returnData['error'] = true;
            $returnData['message'] = $validation->errors()->first();
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }

        try{
            $user = CrmModel::where('email', $request->email)->first();
            if($user)
            {
                if (Hash::check($request->password, $user->password)) {
                    if($user->suspend == 'No')
                    {
                        $returnData['status'] = 200;
                        $returnData['error'] = false;
                        $returnData['message'] = 'User Successfully Logged In';
                        $returnData['data'] = $user;
                        return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message'], $returnData['data']);
                    }else{
                        $returnData['status'] = 401;
                        $returnData['error'] = true;
                        $returnData['message'] = 'You are temporarily suspended';
                        return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
                    }

                }else{
                    $returnData['status'] = 401;
                    $returnData['error'] = true;
                    $returnData['message'] = 'You are not authorized';
                    return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
                }
            }else{
                $returnData['status'] = 401;
                $returnData['error'] = true;
                $returnData['message'] = 'You are not authorized';
                return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
            }
        }catch (\Exception $e)
        {
            $returnData['status'] = 500;
            $returnData['error'] = true;
            $returnData['message'] = $e->getMessage();
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }
    }


    public function updateProfile(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:user_tbl',
            'mobile' => 'required|digits:10',
        ]);

        if ($validation->fails()) {
            $returnData['status'] = 200;
            $returnData['error'] = true;
            $returnData['message'] = $validation->errors()->first();
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }

        $dataToStore['name'] = $request->fullname;
        $dataToStore['email'] = $request->email;
        $dataToStore['mobile'] = $request->mobile;
        $loggedInUser = CrmModel::find($request->loggedInUserId);

        try{
            $result = CrmModel::find($loggedInUser->id)->update($dataToStore);
            if($result)
            {
                $returnData['status'] = 200;
                $returnData['error'] = false;
                $returnData['message'] = 'Profile Updated Successfully';
                $returnData['data'] = CrmModel::find($loggedInUser->id);
                return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message'], $returnData['data']);
            }else{
                $returnData['status'] = 200;
                $returnData['error'] = true;
                $returnData['message'] = 'Profile Not Updated';
                $returnData['data'] = CrmModel::find($loggedInUser->id);
                return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message'], $returnData['data']);
            }
        }catch (\Exception $e)
        {
            $returnData['status'] = 500;
            $returnData['error'] = true;
            $returnData['message'] = $e->getMessage();
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }

    }


}
