<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class UsersController extends Controller
{
    public function userLoginRegister(){
        return view('users.login_register');
    }

    public function login(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();

            // $userStatus = User::where('email',$data['email'])->first();
            // if ($userStatus->status == 0) {
            //     return redirect()->back()->with('flash_message_error','Your account is not activated! Please confirm your email to activate.');
            // }

            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])) {
                
                    Session::put('frontSession',$data['email']);

                if (!empty(Session::get('session_id'))) {
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $data['email']]);
                }

                return redirect('/view-products');

                
            }else{
                return redirect()->back()->with('flash_message_error','Invalid Username or Password!');
            }
        }
    }

    public function register(Request $request){
        if ($request->isMethod('post')) {
        	$data = $request->all();
        	// echo "<pre>"; print_r($data); die;
        	// Check if User already exists
        	$usersCount = User::where('email',$data['email'])->count();
        	if ($usersCount>0) {
        		return redirect()->back()->with('flash_message_error','Email already exists!');
        	}else{
                
                if (empty($data['name'])) {
                return redirect()->back()->with('flash_message_error','Please enter your Name!');
                }

                if (empty($data['email'])) {
                return redirect()->back()->with('flash_message_error','Please enter your Email!');
                }

                if (empty($data['password'])) {
                return redirect()->back()->with('flash_message_error','Please provide your Password!');
                }

                /* Get credentials from .env */
                $token = getenv("TWILIO_AUTH_TOKEN");
                $twilio_sid = getenv("TWILIO_SID");
                $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
                $twilio = new Client($twilio_sid, $token);
                $twilio->verify->v2->services($twilio_verify_sid)
                    ->verifications
                    ->create($data['email'], "sms");

        		$user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                // Send Register Email
                // $email = $data['email'];
                // $messageDate = ['email'=>$data['email'],'name'=>$data['name']];
                // Mail::send('emails.register',$messageDate,function($message) use($email){
                //     $message->to($email)->subject('Registration with E-com Website');
                // });

                // $email = $data['email'];
                //  $messageDate = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                // Mail::send('emails.confirmation',$messageDate,function($message) use($email){
                //      $message->to($email)->subject('Confirm your E-com Account');
                // });

                // return redirect()->back()->with('flash_message_success','Please confirm your email to activate your account!');

                Session::put('emailSession',$data['email']);
                Session::put('passwordSession',$data['password']);

                return redirect('/verify');

                // if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                //      Session::put('frontSession',$data['email']);

                //      if (!empty(Session::get('session_id'))) {
                //         $session_id = Session::get('session_id');
                //         DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $data['email']]);
                //      }

                //      return redirect('/cart');
                // }
        	}
        }
    }

    public function sendsms(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            
            /* Get credentials from .env */
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($data['email'], "sms");
                    
            return redirect()->back()->with('flash_message_success','Send sms successfuly!');
        }
    }

    public function verify(){
    return view('users.verify');
    }

    public function confirm(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;


        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verify'], array('to' => $data['email']));
        if ($verification->valid) {
            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {

                     User::where('email',$data['email'])->update(['status'=>1]);
                     Session::put('frontSession',$data['email']);

                     Session::forget('emailSession');
                     Session::forget('passwordSession');

                     if (!empty(Session::get('session_id'))) {
                        $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $data['email']]);
                     }

                     return redirect('/view-products');
            }
        }else{
            return redirect()->back()->with('flash_message_error','Error sms!');
        }
                
        }
    }

    public function forgotPassword(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            $userCount = User::where('email',$data['email'])->count();
            if ($userCount == 0) {
                return redirect()->back()->with('flash_message_error','Email does not exists!');
            }

            Session::put('emailSession',$data['email']);
            Session::put('passwordSession',$data['password']);

            /* Get credentials from .env */
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($data['email'], "sms");

            // // Get User Details
            // $userDetails = User::where('email',$data['email'])->first();

            // // Generate Random Password
            // $random_password = str_random(8);

            // // Encode/Secure Password
            // $new_password = bcrypt($random_password);

            // // Update Password
            // User::where('email',$data['email'])->update(['password'=>$new_password]);

            // // Send Forgot Password Email Code
            // $email = $data['email'];
            // $name = $userDetails->name;
            // $messageData = [
            //    'email'=>$email,
            //    'name'=>$name,
            //    'password'=>$random_password
            // ];
            // Mail::send('emails.forgotpassword',$messageData,function($message) use($email){
            //     $message->to($email)->subject('New Password - E-com Website');
            // });
            return redirect('/forgot-passwordverify');
        }
        return view('users.forgot_password');
    }

    public function forgotPasswordverify(){
    return view('users.forgot_passwordverify');
    }

    public function forgotPasswordconfirm(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;


        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verify'], array('to' => $data['email']));
        if ($verification->valid) {
            User::where('email',$data['email'])->update(['password'=>bcrypt($data['password'])]);
            User::where('email',$data['email'])->update(['status'=>1]);
            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {

                     Session::put('frontSession',$data['email']);

                     Session::forget('emailSession');
                     Session::forget('passwordSession');

                     if (!empty(Session::get('session_id'))) {
                        $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $data['email']]);
                     }

                     return redirect('/view-products');
            }
        }else{
            return redirect()->back()->with('flash_message_error','Error sms!');
        }
                
        }
    }

    public function confirmAccount($email){
        $email = base64_decode($email);
        $userCount = User::where('email',$email)->count();
        if ($userCount > 0) {
            $userDetails = User::where('email',$email)->first();
            if ($userDetails->status == 1) {
                return redirect('login-register')->with('flash_message_success','Your Email account is already activated. You can login now.');
            }else{
                User::where('email',$email)->update(['status'=>1]);

                // Send Welcome Email
                $messageDate = ['email'=>$email,'name'=>$userDetails->name];
                Mail::send('emails.welcome',$messageDate,function($message) use($email){
                    $message->to($email)->subject('Welcome to E-com Website');
                });

                return redirect('login-register')->with('flash_message_success','Your Email account is activated. You can login now.');
            }
        }else{
            abort(404);
        }
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        if ($request->isMethod('post')) {
            $data = $request->all();

            if (empty($data['name'])) {
                return redirect()->back()->with('flash_message_error','Please enter your Name to update your account details!');
            }

            if (empty($data['email'])) {
                return redirect()->back()->with('flash_message_error','Please enter your Phone to update your account details!');
            }

            Session::put('name_Session',$data['name']);
            Session::put('phone_Session',$data['email']);

            /* Get credentials from .env */
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($data['email'], "sms");

            

            // $user = User::find($user_id);
            // $user->name = $data['name'];
            // $user->email = $data['email'];
            // $user->save();

            return redirect('/editphoneverify');
        }
        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function editphoneverify(Request $request){
        return view('users.editphoneverify');
    }

    public function editphoneverifyconfirm(Request $request){
        if ($request->isMethod('post')) {
            $user_id = Auth::user()->id;
            $userDetails = User::find($user_id);
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;


        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verify'], array('to' => $data['email']));
        if ($verification->valid) {

                     Session::put('frontSession',$data['email']);

                     $user = User::find($user_id);
                     $user->name = $data['name'];
                     $user->email = $data['email'];
                     $user->save();

                     

                     Session::forget('name_Session');
                     Session::forget('phone_Session');

                     if (!empty(Session::get('session_id'))) {
                        $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $data['email']]);
                     }

                     return redirect('/account')->with('flash_message_success','Your account is updated.');
            
        }else{
            return redirect()->back()->with('flash_message_error','Error sms!');
        }
                
        }
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if (Hash::check($current_password,$check_password->password)) {
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if (Hash::check($current_pwd,$old_pwd->password)) {
                // Update password
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','Password Updated successfuly!');
            }else{
                return redirect()->back()->with('flash_message_error','Current Password is incorrect!');
            }
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }

    public function checkEmail(Request $request){
        	$data = $request->all();
        	// Check if User already exists
        	$usersCount = User::where('email',$data['email'])->count();
        	if ($usersCount>0) {
        		echo "false";
        	}else{
        		echo "true"; die;
        	}
    }
}
