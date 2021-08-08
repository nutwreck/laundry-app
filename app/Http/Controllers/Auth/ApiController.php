<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Response\API;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;
use App\Models\User;
use App\Models\Audit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTFactory;

class ApiController extends API
{
    public function register(Request $request)
    {
    	//Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->respondBadRequest($validator->messages());
        }

        try {
            //Request is valid, create new user
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            //User created, return success response
            return $this->respondActionRequest('User created successfully.');
        } catch (\Exception $e) {
            return $this->respondInvalidRequest($e->getMessage());
        }
    }
 
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->respondBadRequest($validator->messages());
        }

        //Request is validated, creating token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->respondBadRequest('Invalid login credentials.');
            }

            $selected_column = ['id'];
            $user = User::where('email', $request->email)->first($selected_column);
            $payloadable = [
                'user_id' => $user->id,
            ];
            $token = JWTAuth::encode(JWTFactory::aud('data')->data($payloadable)->make());

            //create audit trail data
            $audit_data = [
                'user_type'         => "App\Models\User",
                'user_id'           => auth()->user()->id,
                'auditable_id'      => auth()->user()->id,
                'auditable_type'    => "App\Controllers\Auth\ApiController",
                'event'             => "Logged In",
                'url'               => request()->fullUrl(),
                'ip_address'        => request()->getClientIp(),
                'user_agent'        => request()->userAgent(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ];
            Audit::create($audit_data);
        
            //Token created, return with success response and jwt token
            return $this->respondLoginSuccess('User successfully logged in.', $token);
        } catch (JWTException $e) {
            return $this->respondInternalError('Token failed to generate.');
        }
    }
 
    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->respondBadRequest($validator->messages());
        }

		//Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);
            
            return $this->respondSuccessRequest('User successfully logged out.');
        } catch (JWTException $exception) {
            return $this->respondInternalError('Sorry, the user failed to log out.');
        }
    }
 
    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $user = JWTAuth::authenticate($request->token);

        return $this->respondGetSuccess('User data retrieved successfully.', $user);
    }
}
