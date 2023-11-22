<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //
    public function getGoogleSignInUrl()
    {
        return Socialite::driver('google')
            ->redirect();
//        try {
//            $url = Socialite::driver('google')->stateless()
//                ->redirect()->getTargetUrl();
//            return response()->json([
//                'url' => $url,
//            ])->setStatusCode(Response::HTTP_OK);
//        } catch (\Exception $exception) {
//            return $exception;
//        }
    }

    public function loginCallback(Request $request)
    {
        try {
            $state = $request->input('state');
            parse_str($state, $result);
            $googleUser = Socialite::driver('google')->user();
            $user = DB::table('nguoidung')
                ->where('email', $googleUser->email)
                ->first();
            if ($user) {
                Auth::Login($user);
                return redirect('viewHome');
            }
            else{


                $user = DB::table('nguoidung')
                    ->insert(
                        [
                            'email' => $googleUser->email,
                            'user_name' => $googleUser->email,
                            'Ho' =>  $googleUser->user['family_name'],
                            'Ten' =>  $googleUser->user['given_name'],
                            'google_id'=> $googleUser->id,
                        ]
                    );
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status' => __('google sign in failed'),
                'error' => $exception,
                'message' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
