<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function logout(Request $request)
    {   
        // Auth::logout();
        auth()->user()->tokens()->delete();
        
        $request->session()->invalidate();
    
        // $request->session()->regenerateToken();
    
        // return redirect('/');
        return [
            'message' => 'Logged out'
        ];
    }

    public function authenticate(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Unauthorized'
                ]);
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }

    // $postInput = [
    //     "email" => $emailfillter,
    //     "phone" => $phonefillter
    // ];
    
    // $headers = [
    //     'X-header' => 'value'
    // ];
    
    // $response = Http::withHeaders($headers)->post($apiURL, $postInput);
    
    // $statusCode = $response->status();            
    
    // if ($statusCode == 200) {
    //     $responseBody = json_decode($response->getBody(), true);
    //     $data = $responseBody;
    // }



    public function logout1(Request $request): RedirectResponse
    {   
        Auth::logout();        
        
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function authenticate1(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            
            return redirect()->route('shift_user.list');
            // ->intended('shift_user.list');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    
}
