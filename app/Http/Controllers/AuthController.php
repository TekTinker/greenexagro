<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/3/2016
 * Time: 7:04 PM
 */

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Consultant;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Reset;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Session;

class AuthController extends Base
{

    public function getSignUp()
    {
        return view('pages.signup');
    }


    public function getForgotPage()
    {
        return view('pages.forgot_password');
    }

    public function getResetPage()
    {
        $user = User::find(Session::get('user_id'));
        return view('pages.reset_password', [
            'user' => $user,
        ]);
    }


    public function postForgotPage(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
        ]);


        if (User::where('email', $request->input('login'))->first()) {

            $user = User::where('email', $request->input('login'))->first();

            if (Reset::where('mobile', $user->mobile)->first()) {

                $reset = Reset::where('mobile', $user->mobile)->first();

                $dateUpdated = new DateTime($reset->updated_at);
                $dateNow = new DateTime("now");

                $dateDifference = $dateNow->diff($dateUpdated);

                if ($dateDifference->format('%d') >= 1) {
                    $reset->attempt = 0;
                    $reset->pin = str_random(6);
                    $reset->save();

                    $this->sendResetcode($user, $reset);
                }

                Session::put('user_id', $user->id);
                return redirect()->route('auth.reset');

            } else {

                Reset::create([
                    'email' => $user->email,
                    'mobile' => $user->mobile,
                    'pin' => str_random(6),
                    'attempt' => '0',
                ]);

                $reset = Reset::where('email', $user->email)->first();

                $this->sendResetcode($user, $reset);

                Session::put('user_id', $user->id);
                return redirect()->route('auth.reset');

            }


        } elseif (User::where('mobile', $request->input('login'))->first()) {

            $user = User::where('mobile', $request->input('login'))->first();

            if (Reset::where('mobile', $user->mobile)->first()) {

                $reset = Reset::where('mobile', $user->mobile)->first();

                $dateUpdated = new DateTime($reset->updated_at);
                $dateNow = new DateTime("now");

                $dateDifference = $dateNow->diff($dateUpdated);

                if ($dateDifference->format('%h') >= 24) {
                    $reset->attempt = 0;
                    $reset->pin = str_random(6);
                    $reset->save();

                    $this->sendResetcode($user, $reset);
                }


                Session::put('user_id', $user->id);
                return redirect()->route('auth.reset');

            } else {

                Reset::create([
                    'email' => $user->email,
                    'mobile' => $user->mobile,
                    'pin' => str_random(6),
                    'attempt' => '0',
                ]);

                $reset = Reset::where('email', $user->email)->first();

                $this->sendResetcode($user, $reset);

                Session::put('user_id', $user->id);
                return redirect()->route('auth.reset');

            }

        } else {

            return redirect()->back()->with('info-danger', 'User with given email / mobile does not exist.');

        }
    }

    public function postResetPage(Request $request)
    {

        $this->validate($request, [
            'pin' => 'required',
            'password' => 'required|min:6',
            'confirm' => 'required|same:password',
        ]);

        $user = User::find($request->input('id'));

        $reset = Reset::where('mobile', $user->mobile)->first();


        $dateUpdated = new DateTime($reset->updated_at);
        $dateNow = new DateTime("now");

        $dateDifference = $dateNow->diff($dateUpdated);

        if ($dateDifference->format('%d') >= 1) {
            $reset->attempt = 0;
            $reset->pin = str_random(6);
            $reset->save();
            $this->sendResetcode($user, $reset);

        } elseif ($reset->attempt >= 3) {
            return redirect()->back()->with('info-danger', 'Too many attempts try again after 24 hours');
        } elseif ($reset->pin == $request->input('pin')) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
            $reset->delete();
            Session::forget('user_id');
            return redirect()->route('auth.login')->with('info', 'Password changed successfully. Now you can login');
        } else {

            $reset->attempt = $reset->attempt + 1;
            $reset->save();
            return redirect()->back()->with('info-danger', 'Incorrect pin');
        }

    }


    public function postSignUp(Request $request)
    {

        $this->validate($request, [
            'email' => 'email|unique:users',
            'name' => 'required|string|max:60',
            'role' => 'required',
            'address' => 'required|string',
            'taluka' => 'required|alpha',
            'district' => 'required|alpha',
            'pin' => 'required|digits:6',
            'mobile' => 'required|digits:10|unique:users',
            'password' => 'required|min:6',
            'confirm' => 'required|same:password',
        ]);


        $uid = null;
        do {
            $uid = rand(1010200, 9090002);
            $user = User::where('uid', $uid)->get();
        } while (isset($user->uid));


        User::create([
            'email' => $request->input('email'),
            'uid' => $uid,
            'mobile' => $request->input('mobile'),
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user = User::where('email', $request->input('email'))->first();

        $this->sendSMS("GREENEX", $request->input('mobile'), "Thank you for signing up with Greenex Agro Chemicals.");

        $this->sendWelcome($user);


        if ($request->input('role') == 'customer') {
            Customer::create([
                'customer_id' => $user['id'],
                'address' => $request->input('address'),
                'taluka' => $request->input('taluka'),
                'district' => $request->input('district'),
                'pin' => $request->input('pin'),
            ]);

            Cart::create([
                'cart_id' => $user['id'],
                'total_items' => 0,
                'total_price' => 0,
            ]);

            Auth::attempt($request->only(['email', 'password']));

            return redirect()->route('customer.sign_up.add_farms')->with('info', 'Add your crop/farm details.');
        } else if ($request->input('role') == 'consultant') {
            Consultant::create([
                'consultant_id' => $user['id'],
                'address' => $request->input('address'),
                'taluka' => $request->input('taluka'),
                'district' => $request->input('district'),
                'pin' => $request->input('pin'),
            ]);
            Cart::create([
                'cart_id' => $user['id'],
                'total_items' => 0,
                'total_price' => 0,
            ]);

            return redirect()->route('auth.login')->with('info', 'Successfully signed up. You can now login');
        } else if ($request->input('role') == 'employee') {
            Employee::create([
                'employee_id' => $user['id'],
                'address' => $request->input('address'),
                'taluka' => $request->input('taluka'),
                'district' => $request->input('district'),
                'pin' => $request->input('pin'),
                'status' => 0,
            ]);

            return redirect()->route('auth.login')->with('info', 'Successfully signed up. You can now login');
        }
    }

    public function sendSMS($senderID, $receiver, $msg)
    {
        $ch = curl_init();
        $user = "admin@greenexagro.com:Sandeep@1233";
        $receipientno = $receiver;
        $senderID = "TEST SMS";
        $msgtxt = $msg;
        curl_setopt($ch, CURLOPT_URL, "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
        $buffer = curl_exec($ch);
        if (empty ($buffer)) {
            echo " buffer is empty ";
        } else {
            echo $buffer;
        }
        curl_close($ch);
    }

    public function getLogin()
    {
        return view('pages.login');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home')->with('info', 'Successfully logged out.');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->input('login'), 'password' => $request->input('password')], $request->has('remember'))) {

            return redirect()->route('home')->with('info', 'Successfully logged in.');

        } elseif (Auth::attempt(['mobile' => $request->input('login'), 'password' => $request->input('password')], $request->has('remember'))) {

            return redirect()->route('home')->with('info', 'Successfully logged in.');

        } else {

            return redirect()->back()->with('info-danger', 'Invalid credentials.');

        }


    }

    public function sendWelcome(User $user){
        $to = $user->email;
        $subject = "Welcome to Greenex Agro Chemicals";
        $txt = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"> <html xmlns=\"http://www.w3.org/1999/xhtml\"> <head style=\"font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" style=\"font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" style=\"font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <title style=\"font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\">Welcome to Greenex Agro Chemicals, $user->name!</title> <style type=\"text/css\" rel=\"stylesheet\" media=\"all\" style=\"font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> /* Base ------------------------------ */ *:not(br):not(tr):not(html) {font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; -webkit-box-sizing: border-box; box-sizing: border-box; } body {width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F2F4F6; color: #74787E; -webkit-text-size-adjust: none; } a {color: #3869D4; } /* Layout ------------------------------ */ .email-wrapper {width: 100%; margin: 0; padding: 0; background-color: #F2F4F6; } .email-content {width: 100%; margin: 0; padding: 0; } /* Masthead ----------------------- */ .email-masthead {padding: 25px 0; text-align: center; } .email-masthead_logo {max-width: 400px; border: 0; } .email-masthead_name {font-size: 16px; font-weight: bold; color: #bbbfc3; text-decoration: none; text-shadow: 0 1px 0 white; } /* Body ------------------------------ */ .email-body {width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF; } .email-body_inner {width: 570px; margin: 0 auto; padding: 0; } .email-footer {width: 570px; margin: 0 auto; padding: 0; text-align: center; } .email-footer p {color: #AEAEAE; } .body-action {width: 100%; margin: 30px auto; padding: 0; text-align: center; } .body-sub {margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2; } .content-cell {padding: 35px; } .align-right {text-align: right; } /* Type ------------------------------ */ h1 {margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left; } h2 {margin-top: 0; color: #2F3133; font-size: 16px; font-weight: bold; text-align: left; } h3 {margin-top: 0; color: #2F3133; font-size: 14px; font-weight: bold; text-align: left; } p {margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em; text-align: left; } p.sub {font-size: 12px; } p.center {text-align: center; } /* Buttons ------------------------------ */ .button {display: inline-block; width: 200px; background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 45px; text-align: center; text-decoration: none; -webkit-text-size-adjust: none; mso-hide: all; } .button--green {background-color: #22BC66; } .button--red {background-color: #dc4d2f; } .button--blue {background-color: #3869D4; } /*Media Queries ------------------------------ */ @media only screen and (max-width: 600px) {.email-body_inner, .email-footer {width: 100% !important; } } @media only screen and (max-width: 500px) {.button {width: 100% !important; } } </style> </head> <body style=\"height: 100%;margin: 0;line-height: 1.4;background-color: #F2F4F6;color: #74787E;-webkit-text-size-adjust: none;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;width: 100% !important;\"> <table class=\"email-wrapper\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;margin: 0;padding: 0;background-color: #F2F4F6;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <tr> <td align=\"center\" style=\"font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <table class=\"email-content\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;margin: 0;padding: 0;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <!-- Logo --> <tr> <td class=\"email-masthead\" style=\"padding: 25px 0;text-align: center;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <a class=\"email-masthead_name\" style=\"color: #bbbfc3;font-size: 16px;font-weight: bold;text-decoration: none;text-shadow: 0 1px 0 white;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\">Greenex Agro Chemicals</a> </td> </tr> <tr> <td class=\"email-body\" width=\"100%\" style=\"width: 100%;margin: 0;padding: 0;border-top: 1px solid #EDEFF2;border-bottom: 1px solid #EDEFF2;background-color: #FFF;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <table class=\"email-body_inner\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 570px;margin: 0 auto;padding: 0;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <tr> <td class=\"content-cell\" style=\"padding: 35px;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <h1 style=\"margin-top: 0;color: #2F3133;font-size: 19px;font-weight: bold;text-align: left;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\">Hi $user->name,</h1> <p style=\"margin-top: 0;color: #74787E;font-size: 16px;line-height: 1.5em;text-align: left;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\">Thanks for signing up for Greenex Agro Chemicals. We’re very excited to have you on board.</p> <p style=\"margin-top: 0;color: #74787E;font-size: 16px;line-height: 1.5em;text-align: left;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\">To get started using Greenex Agro Chemicals, please confirm your account below:</p> <p style=\"margin-top: 0;color: #74787E;font-size: 16px;line-height: 1.5em;text-align: left;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\">Check your  accout details : <br> UID : $user->uid <br> Name : $user->name <br> Email : $user->email <br> Mobile : $user->mobile <br> </p> <p style=\"margin-top: 0;color: #74787E;font-size: 16px;line-height: 1.5em;text-align: left;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\">Thanks,<br>Greenex Agro Chemicals</p> </td> </tr> </table> </td> </tr> <tr> <td style=\"font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <table class=\"email-footer\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 570px;margin: 0 auto;padding: 0;text-align: center;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <tr> <td class=\"content-cell\" style=\"padding: 35px;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> <p class=\"sub center\" style=\"margin-top: 0;color: #AEAEAE;font-size: 12px;line-height: 1.5em;text-align: center;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\">&copy; 2016 Greenex Agro Chemicals. All rights reserved.</p> <p class=\"sub center\" style=\"color: #AEAEAE;font-size: 12px;line-height: 1.5em;margin-top: 0;text-align: center;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;-webkit-box-sizing: border-box;box-sizing: border-box;\"> Greenex Agro Chemicals <br>Gut 45 At Shahajatpur Post Lasurgaon,s <br>Taluka Vaijapur, <br>District Aurangabad, 423701. </p> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </body> </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: Greenex Agro Chemicals<no-reply@greenexagro.com>' . "\r\n";

        mail($to,$subject,$txt,$headers);
    }


    public function sendResetcode(User $user, Reset $reset){
        $to = $user->email;
        $subject = "Password Reset Code";
        $txt = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"> <html xmlns=\"http://www.w3.org/1999/xhtml\"> <head> <meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\" /> <meta content=\"text/html; charset=UTF-8\" http-equiv=\"Content-Type\" /> <title>Password Reset Code for Greenex Agro Chemicals</title> </head> <body style=\"background-color: #F2F4F6; color: #74787E; height: 100%; line-height: 1.4; margin: 0; width: 100% !important;\"> <table cellpadding=\"0\" cellspacing=\"0\" class=\"email-wrapper\" style=\"background-color: #F2F4F6; margin: 0; padding: 0; width: 100%;\" width=\"100%\"> <tr> <td align=\"center\"> <table cellpadding=\"0\" cellspacing=\"0\" class=\"email-content\" style=\"margin: 0; padding: 0; width: 100%;\" width=\"100%\"> <!-- Logo --> <tr> <td class=\"email-masthead\" style=\"padding: 25px 0; text-align: center;\"><a class=\"email-masthead_name\" style=\"color: #bbbfc3; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;\">Greenex Agro Chemicals</a></td> </tr> <!-- Email Body --> <tr> <td class=\"email-body\" style=\"background-color: #FFF; border-bottom: 1px solid #EDEFF2; border-top: 1px solid #EDEFF2; margin: 0; padding: 0; width: 100%;\" width=\"100%\"> <table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"email-body_inner\" style=\"margin: 0 auto; padding: 0; width: 570px;\" width=\"570\"> <!-- Body content --> <tr> <td class=\"content-cell\" style=\"padding: 35px;\"> <h1 style=\"color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;\">Hi $user->name,</h1> <p style=\"color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">You recently requested to reset your password for your Greenex Agro Chemicals account. Use the following code to reset password.</p> <!-- Action --> <table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"body-action\" style=\"margin: 30px auto; padding: 0; text-align: center; width: 100%;\" width=\"100%\"> <tr> <td align=\"center\"> <div> <!--[if mso]><v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" href=\"{{action_url}}\" style=\"height:45px;v-text-anchor:middle;width:200px;\" arcsize=\"7%\" stroke=\"f\" fill=\"t\"> <v:fill type=\"tile\" color=\"#dc4d2f\" /> <w:anchorlock/> <center style=\"color:#ffffff;font-family:sans-serif;font-size:15px;\">Reset your password</center> </v:roundrect><![endif]--> <div class=\"button button--red\" href=\"{{action_url}}\" style=\"background-color: #dc4d2f; border-radius: 3px; color: #ffffff; display: inline-block; font-size: 15px; line-height: 45px; mso-hide: all; text-align: center; text-decoration: none; width: 200px;\">$reset->pin </div> </div> </td> </tr> </table> <p style=\"color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">If you did not request a password reset, please ignore this email or reply to let us know. This password reset is only valid for limited time.</p> <p style=\"color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;\">Thanks,<br />Greenex Agro Chemicals</p> </td> </tr> </table> </td> </tr> <tr> <td> <table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"email-footer\" style=\"margin: 0 auto; padding: 0; text-align: center; width: 570px;\" width=\"570\"> <tr> <td class=\"content-cell\" style=\"padding: 35px;\"> <p class=\"sub center\" style=\"color: #AEAEAE; font-size: 12px; line-height: 1.5em; margin-top: 0; text-align: center;\">&copy; 2016 Greenex Agro Chemicals. All rights reserved.</p> <p class=\"sub center\" style=\"color: #AEAEAE; font-size: 12px; line-height: 1.5em; margin-top: 0; text-align: center;\"> Greenex Agro Chemicals <br />Gut 45 At Shahajatpur Post Lasurgaon,s <br />Taluka Vaijapur, <br />District Aurangabad, 423701. </p> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </body> </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: Greenex Agro Chemicals<no-reply@greenexagro.com>' . "\r\n";

        mail($to,$subject,$txt,$headers);
    }
}