<?php

namespace App\Http\Controllers;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{

     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        // get email and password from request
        $credentials = request(['email', 'password']);
        $conHash = Hash::make(request('password'));
        // try to auth and get the token using api authentication
        //$token= auth('api')

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials','credentiasl'=>$credentials,'hash'=>$conHash], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }


        // if (!$token = auth('api')->attempt($credentials)) {
        //     // if the credentials are wrong we send an unauthorized error in json format
        //     return response()->json(['error' => 'Unauthorized','credentials'=>$credentials,'hash'=>$conHash], 401);
        // }
        return response()->json([
            'token' => $token,
            'type' => 'bearer', // you can ommit this
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    // public function authenticate (Request $request){
    //     $credentials = $request->only('email','password');

    //     try {
    //         if(!$token = JWTAuth::attempt($credentials)){
    //             return response()->json(['error'=>'invalid_credentials']);
    //         }
    //     } catch (JWTException $e) {
    //         return response()->json(['error'=>'could_no_create_token']);
    //     }

    //     $response = compact('token');
    //     //$response['user'] = Auth::user();

    //     return $response;
    // }
}
