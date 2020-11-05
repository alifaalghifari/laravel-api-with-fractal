<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Transformers\UserTransformer;
use App\Models\User;
use Facade\FlareClient\Http\Response;

class AuthController extends Controller
{
    public function register(StoreUserPost $request, User $user)
    {
        $validated = (object) $request->validated();

        // Hasing password and api_token
        $hashPassword = Hash::make($validated->password);
        // api_token is data from email
        $hashApi = Hash::make($validated->email);


        // Check is using post method
        if ($request->isMethod('post')) {
            $user = $user->create([
                'name' => $validated->name,
                'email' => $validated->email,
                'password'  => $hashPassword,
                'api_token' => $hashApi
            ]);
        }
        $response = fractal()->item($user)->transformWith(new UserTransformer)->toArray();

        return response()->json($response, 201);
    }

    public function login(Request $request, User $user)
    {

        if (!Auth::attempt(['email' => 'rudi@gmail.com', 'password' => 'rudiabc'])) {
            return response()->json(['error' => 'Login Error'], 401);
        }
        $user = $user->find(Auth::user()->id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();
    }
}
