<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginApiService
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->response(false, 'Validation error', $validator->errors(), 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return $this->response(false, 'Email & Password do not match our records.', null, 401);
            }

            $user = User::query()->where('email', $request->email)->first();

            return $this->response(true, 'User logged in successfully', [
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ]);

        } catch (\Throwable $th) {
            return $this->response(false, $th->getMessage(), null, 500);
        }
    }

    private function response($status, $message, $data = null, $statusCode = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
