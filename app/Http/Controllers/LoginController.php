<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            return redirect('/');
        }

        $method = $request->method();
        $errorMessage = null;
        
        if ($method == "POST") {
            $withErrors = [];
            if(!$request->email){
                $withErrors['email'] = 'The email field is required';
            }
            
            if(!$request->password){
                $withErrors['password'] = 'The password field is required';
            }

            if(count($withErrors) > 0){
                return view('login', compact('request', 'errorMessage', 'user'))->withErrors($withErrors);
            }

            $valid_item = [
                'email' => 'required',
                'password' => 'required'
            ];
            $validated = $request->validate($valid_item);
            
            if (Auth::attempt($validated)) {
                $user = Auth::user();
                $user->login = new \DateTime();
                $user->logintime = ($user->logintime + 1);
                $user->attempt = 0;                
                
                // if ($user->status) {
                if(!empty($request->return_url)){
                    return redirect($request->return_url);
                }
                else{
                    if($user->type == 'ADMIN'){
                        return redirect('/admin');
                    }

                    return redirect('/');
                }
                // }

                if (!$user->status) {
                    $errorMessage = 'Your account has not been activated yet.  Please activate';
                }
                // Auth::logout();
            }
            else{
                $errorMessage = 'Wrong login info';
            }
        }

        return view('login', compact('request', 'errorMessage', 'user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
