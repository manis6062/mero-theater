<?php

namespace App\Http\Controllers\API\V1;

use App\ApiChangePassword;
use App\CrmModel;
use App\Mail\SendChangePasswordMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Response\ApiResponse;

class SettingsController extends Controller
{
    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
            'confirmation_type' => 'required',
        ]);

        if ($validation->fails()) {
            $returnData['status'] = 200;
            $returnData['error'] = true;
            $returnData['message'] = $validation->errors()->first();
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }

        $loggedInUser = $request->loggedInUserId;

        try{
            if (Hash::check($request->old_password, $loggedInUser->password)) {
                if(ApiChangePassword::where('user_id', $loggedInUser->id)->first() != null)
                {
                    ApiChangePassword::where('user_id', $loggedInUser->id)->delete();
                }
                $confirmationCode = $this->createUniqueConfirmationCode();
                ApiChangePassword::create([
                   'user_id' =>  $loggedInUser->id,
                    'new_password' => $request->new_password,
                    'confirmation_code' => $confirmationCode
                ]);

                if($request->confirmation_type == 'email') {
                    $mailData['subject'] = 'Confirmation code for changing password';
                    $mailData['message'] = 'Your confirmation code for changing password is '.$confirmationCode;
                    try{
                        Mail::to($loggedInUser->email)->send(new SendChangePasswordMail($mailData));
                        $returnData['status'] = 200;
                        $returnData['error'] = false;
                        $returnData['message'] = 'Mail sent successfully';
                        return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
                    }catch (\Exception $e)
                    {
                        $returnData['status'] = 500;
                        $returnData['error'] = true;
                        $returnData['message'] = $e->getMessage();
                        return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
                    }

                }else{
                    try {
                        $curlData = [
                            'auth_token' => '280de33124ef7c7ccee6b92c4e0c89eba8fdadbaa467d653a72ffd7d7e7a8ac4',
                            'from' => '31001',
                            'to' => $loggedInUser->mobile,
                            'text' => 'Your confirmation code for changing password is '.$confirmationCode
                        ];
                        $url = "http://aakashsms.com/admin/public/sms/v1/send";

                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, $url);

                        curl_setopt($ch, CURLOPT_POST, 1);

                        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlData);

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                        $response = curl_exec($ch);

                        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                        curl_close($ch);

                        $returnData['status'] = 200;
                        $returnData['error'] = false;
                        $returnData['message'] = 'SMS sent successfully';
                        return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);

                    } catch (\Exception $e) {
                        $returnData['status'] = 500;
                        $returnData['error'] = true;
                        $returnData['message'] = $e->getMessage();
                        return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
                    }
                }
            }else{
                $returnData['status'] = 200;
                $returnData['error'] = true;
                $returnData['message'] = 'Incorrect Old Password';
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

    public function createUniqueConfirmationCode()
    {
        $cc = rand(100000, 999999);
        $check = ApiChangePassword::where('confirmation_code', $cc)->count();
        if($check > 0)
            $this->createUniqueConfirmationCode();

        return $cc;
    }

    public function changePasswordConfirmation(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'confirmation_code' => 'required',
        ]);

        if ($validation->fails()) {
            $returnData['status'] = 200;
            $returnData['error'] = true;
            $returnData['message'] = $validation->errors()->first();
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }

        $confirmationCode = $request->confirmation_code;
        $loggedInUser = CrmModel::find($request->loggedInUserId);
        if(ApiChangePassword::where('user_id', $loggedInUser->id)->first()->confirmation_code == $confirmationCode)
        {
            $newPass = ApiChangePassword::where('user_id', $loggedInUser->id)->first()->new_password;
            ApiChangePassword::where('user_id', $loggedInUser->id)->delete();
            CrmModel::find($loggedInUser->id)->update([
               'password' => bcrypt($newPass)
            ]);
            $returnData['status'] = 200;
            $returnData['error'] = false;
            $returnData['message'] = 'Password Changed Successfully';
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }else{
            $returnData['status'] = 200;
            $returnData['error'] = true;
            $returnData['message'] = 'Confirmation Code did not match';
            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message']);
        }
    }
}
