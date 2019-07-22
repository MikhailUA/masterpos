<?php

namespace App\Http\Controllers;

use Validator;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller;
use App\User;

class AuthController extends Controller 
{

    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }    

    protected function jwt(User $user) {
        $payload = [
           'iss' => "masterpos-jwt", // Issuer of the token
           'sub' => $user->id, // Subject of the token
           'iat' => time(), // Time when JWT was issued. 
           'exp' => time() + 60*60 // Expiration time
       ];
     
     // As you can see we are passing `JWT_SECRET` as the second parameter that will 
       // be used to decode the token in the future.
       
       return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function userAuthenticate(User $user) {
        $this->validate($this->request, [
            'login'     => 'required',
            'password'  => 'required'
        ]);
        
        $user = User::where('email', $this->request->json('login'))->first(); 

        if (!$user) {
            
            return response()->json([
                'error' => 'User does not exist.'
            ], 400);

        }
      
        // Verify the password and generate the token

        if (Hash::check($this->request->json('password'), $user->password)) {
          
            return response()->json([
                'message' => 'Login Successful',
                'token' => $this->jwt($user) // return token
            ], 200);
        }

        return response()->json([
            'error' => 'Login details provided does not exit.'
        ], 400);
    } 
}
