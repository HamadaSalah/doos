<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function userRegister(Request $request)
    {
        return $this->Regsiter($request, User::class);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function employeeRegister(Request $request)
    {
        return $this->Regsiter($request, Employee::class);

    }

    /**
     * @param Request $request
     * @param $model
     * @return JsonResponse
     */
    public function Regsiter(Request $request,  $model): JsonResponse
    {
        try {

            $validateUser = Validator::make($request->all(),
                ['phone' => 'required']
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $code = rand ( 100000 , 999999 );

            $user = $model::firstOrCreate([
                'phone' => $request->phone],[
                'device_token' => $request->device_token ?? '',
            ]);

            $user->update([
                'otp' => $code
            ]);

            $this->sendOTP($code, $request->phone);

            $abilities = $model === 'App\Models\User' ? ['guard:users'] : ['guard:employees'];

            return response()->json([
                'status' => true,
                'message' => 'OTP Sent Successfully',
                // 'token' => $user->createToken("API TOKEN", $abilities)->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function sendOTP($code, $phone)  {

        $phone  = substr($phone, 1);  

        $client = new Client();
        // Specify the URL for the POST request
        $url = 'https://api.oursms.com/api-a/msgs';

        $message = ' 
        لا تقوم بمشاركة هذا الكود مع احد
        كود التفعيل هو ' . $code ;
        // Define the data you want to send in the request body
        $data = [
            'username' => '966500020502',
            'token' => 'sUKYA7t_ZooPFpTYmneX',
            'src' => 'khadamaty',
            'dests' => $phone,
            'body' => $message,
            'priority' => 0,
            'delay' => 0,
            'validity' => 0,
            'maxParts' => 0,
            'dlr' => 0,
        ];
        
        // Make the POST request
        $response = $client->post($url, [
            'form_params' => $data,  
        ]);

         $body = $response->getBody()->getContents();
     }

     public function matchOTP(Request $request) {

        $request->validate([
            'phone'=> 'required',
            'otp' => 'required'
        ]);

        $user = User::where(['phone'=> $request->phone])->first();

        if($user) {
            if($user->otp == $request->otp) {
                $abilities = $user === 'App\Models\User' ? ['guard:users'] : ['guard:employees'];

                return response()->json([
                    'status' => true,
                    'message' => 'Login Successfully',
                    'token' => $user->createToken("API TOKEN", $abilities)->plainTextToken
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Wrong OTP',
                ], 422);
            }
        } else {
            return response()->json([
                'message' => 'User Not registerd Before',
            ], 422);

        }
     }

     public function employeeMatchOTP(Request $request) {
        $request->validate([
            'phone'=> 'required',
            'otp' => 'required'
        ]);

        $user = Employee::where(['phone'=> $request->phone])->first();

        if($user) {
            if($user->otp == $request->otp) {
                $abilities = $user === 'App\Models\User' ? ['guard:users'] : ['guard:employees'];

                return response()->json([
                    'status' => true,
                    'message' => 'Login Successfully',
                    'token' => $user->createToken("API TOKEN", $abilities)->plainTextToken
                ], 200);
    
            } else {
                return response()->json([
                    'message' => 'Wrong OTP',
                ], 422);
            }
        } else {
            return response()->json([
                'message' => 'User Not registerd Before',
            ], 422);

        }

     }
}
