<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends AppBaseController
{
    public function Login(LoginRequest $request)
    {
        try {
            if ($request->has('email')) {
                $user = User::where('email', $request->email)->first();
            } elseif ($request->has('password')) {
                $user = User::where('phone', $request->phone)->first();
            }
            if (!$user || !Hash::check($request['password'], $user->password)) {
                return $this->sendResponse(
                    null,
                    'Bad Credentials',
                    401,
                    1
                );
            }
            $token = $user->createToken('HopeRoadAPItoken')->plainTextToken;
            $user->getAllPermissions();
            $response = [
                'userInfo' => $user,
                'token' => $token,
            ];
            return $this->sendResponse(
                $response,
                'logged in Successfully',
                200,
                0
            );
        } catch (Exception $e) {
            return $this->sendResponse(
                $e->getMessage(),
                'something wrong',
                500,
                1
            );
        }
    }

    public function logout()
    {
        try {
            auth()->user()->currentAccessToken()->delete();
            return $this->sendResponse(
                null,
                'successfully Logged out',
                200,
                0
            );
        } catch (Exception $e) {
            return $this->sendResponse(
                $e->getMessage(),
                'something wrong',
                500,
                1
            );
        }
    }
}
