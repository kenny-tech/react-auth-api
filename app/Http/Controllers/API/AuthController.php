<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        try {
            if (! filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                return $this->sendError($user = [], 'Invalid email supplied');
            }
    
            $checkEmail = User::where('email', '=', $request->email)->exists();
    
            if ($checkEmail) {
                return $this->sendError($user = [], 'Email already exists');
            }
    
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ];
        
            $user = User::create($data);

            if($user!=null) {
                return $this->sendSuccess($user, 'User successfully created');   
            } else {
                return $this->sendError($user = [], 'Error creating user. Please try again');
            }   
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function signin(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    
                $data = User::whereId(Auth::user()->id)->first();
                            
                return $this->sendSuccess($data, 'success');
            } else {
                return $this->sendError($data = [], 'Incorrect Login Details');
            }    
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
