<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Common\HasApiResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{   
    use HasApiResponse;

    public function register(RegisterRequest $request, User $user)
    {   
        DB::beginTransaction();
        try {
            $user = $user->register($request);
        }
        catch (\Exception $e) {
            DB::rollback();
            Log::error('Registration failed :: ' . $e->getMessage());
            return $this->httpInternalServerError($e->getMessage());
        }
        DB::commit();
        return $this->httpCreated($user, 'User created successfully!');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::guard('web')->attempt($request->validated())) {
            $user = Auth::guard('web')
                        ->user()
                        ->generateApiAuthToken();

            return $this->httpSuccess($user, 'User logged in successfully.');
        }

        return $this->httpNotFoundError('User does not exists with this credentials!');
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return $this->httpSuccess('User logged out!');
    }
}
