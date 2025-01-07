<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use ReCaptcha\ReCaptcha;
use App\Models\User;
use App\Models\States;
use App\Models\Agency;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            return redirect('/');
        }
        
        $states = States::all();

        $agency = [];
        if (request()->query('id')) {
            /** @var Agency $agency */
            $agency = Agency::where('id', request()->query('id'))->first();
        }

        $method = $request->method();
        $recaptcha = new ReCaptcha(env('DATA_SECRETKEY'));
        $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
        $message = "";
        $new_user = null;

        if ($method == "POST") {
            $valid_item = [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
                'firstname' => 'required|min:2',
                'lastname' => 'required|min:2',                
                'city' => 'required|min:3',
                'state' => 'required',
                'zip' => 'required|min:5'
            ];

            if ($response->isSuccess()) {
                // reCAPTCHA verification successful, process the form submission
            }
            else{
                $valid_item['recaptcha-token'] = 'required';
            }

            $validated = $request->validate($valid_item);

            $push_data = [];

            if (request()->query('id')) {
                if ($agency) {
                    $push_data["provider_id"] = $agency->id;
                    $push_data["is_provider"] = 1;
                }
                else{
                    $push_data["provider_id"] = 0;
                    $push_data["is_provider"] = 0;
                }
            }
            else{
                $push_data["provider_id"] = 0;
                $push_data["is_provider"] = 0;
            }

            $push_data["firstname"] = $request->firstname;
            $push_data["lastname"] = $request->lastname;
            $push_data["email"] = $request->email;
            $push_data["state"] = $request->state;
            $push_data["zip"] = $request->zip;
            $push_data["city"] = $request->city;
            $push_data["created"] = new \DateTime();
            $push_data["pwd"] = $request->password;
            $push_data["password"] = bcrypt($request->password);
            $push_data["ip_address"] = request()->ip();
            $push_data["type"] = '';
            $push_data["status"] = false;
            $push_data["resetcode"] = rand(1000001, 99999999);
            $push_data["attempt"] = 0;
            $push_data["logintime"] = 0;
            $push_data["recieve_email"] = 0;

            $new_user = User::create($push_data);

            if($new_user){
                try {
                    $link = $request->getSchemeAndHttpHost() . '/user/activate?id=' . $new_user->id . '&secret=' . $new_user->resetcode;
                    $message = 'Please click on the link below to activate your AdoptionCenter.us account. <br /><br />';
                    $message .= '<a href="' . $link . '">' . $link . '</a>';
                    
                    $data = array(
                        'from_name' => config('mail.from.name'),
                        'from_email' => config('mail.from.address'),
                        'subject' => 'AdoptionCenter.us Registration E-Mail Validation',
                        'message' => $message,
                    );
    
                    Mail::to($request->email)->send(new SendEmail($data));
    
                    $message = 'Thank you for registering.  Your information was successfully saved. <br/> Please check your email for information to activate your account.';
                    $message .= '<br/> If you do not see an email from us, please <strong>check your Spam folder or Junk mail folder</strong>. ';
                } catch (\Exception $e) {
                    $message = $e;
                }
            }
            else{
                $message = 'Please make the following corrections and submit again.';
            }
        }

        return view('register', compact('message', 'user', 'new_user', 'states', 'request', 'agency'));
    }

    public function activate(Request $request)
    {
        $id = $request->id;
        $secret = $request->secret;

        if (!$id || !$secret) {
            return redirect('/');
        }

        /** @var User $user */
        $user = User::where('id', $id)
                    ->where('resetcode', $secret)
                    ->first();

        if (!$user) {
            return redirect('/');
        }

        $user->status = 1;
        $user->save();

        return redirect('/user/login');
    }
}
