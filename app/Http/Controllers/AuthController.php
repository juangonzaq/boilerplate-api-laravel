<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
//use App\Notifications\SignupActivate;
use Avatar;
use Storage;
use Socialite;
use Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => str_random(60),
            'provider' => 'kangoo',
            'provider_id' => 0,
            'user_type' => $request->user_type,
            'doc_id' => $request->doc_id,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!',
            'activation_url' => url('/api/auth/signup/activate/'.$user->activation_token)
        ], 201);
    }

    public function redirectProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function signupProvider($provider)
    {
        $userP = Socialite::driver($provider)->stateless()->user();
        //$tokenP = $userP->token;
        //$tokenSecretP = $userP->tokenSecret;
        $authUser = $this->findOrCreateUser($userP, $provider);
        $tokenResult = $authUser->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        /*pendiente $user->getAvatar()*/
        $authUser = new User([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'provider' => $provider,
            'provider_id' => $user->id,
            'avatar' => 'avatar.png'
        ]);
        $authUser->save();
        return $authUser;
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }

    /**
     * Login user and create token
     *
     * @param  [email] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        if(!Auth::attempt(['email' => $request->input('email'), 'password'  => $request->input('password')]))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        //return $user = Auth::user();

        return response()->json([
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function deactivate(Request $request)
    {
        $user = Auth::user();
        $user->active=false;
        $user->save();
        return response()->json([
            'message' => 'User deactivate successfully!'
        ]);
    }

    public function editProfile(Request $request){
        if($request->new_password!="" && $request->new_password_confirmation!="") {
            if (!(Hash::check($request->current_password, Auth::user()->password))) {
                return response()->json([
                    'message' => 'Your current password does not matches with the password you provided. Please try again.'
                ], 404);
            }

            if (strcmp($request->current_password, $request->new_password) == 0) {
                return response()->json([
                    'message' => 'New Password cannot be same as your current password. Please choose a different password.'
                ], 404);
            }
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:6|confirmed',
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users'
            ]);
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->doc_id = $request->doc_id;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->new_password);
            $user->save();
        }else{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users'
            ]);
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->doc_id = $request->doc_id;
            $user->phone = $request->phone;
            $user->save();
        }
        return response()->json([
            'message' => 'Profile changed successfully!'
        ]);
    }
}