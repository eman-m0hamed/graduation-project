<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class ForgetPasswordController extends Controller
{

    public function restpass(Request $request)
    {
        $numHash = rand();
        $confirm_number = Hash::make($numHash);

        $request->validate([
            'email' => 'required|email',

        ]);
        // $new_password = $request->get('password');
        $check_mail = $request->get('email');
        $mails_DB = DB::select('select email from doctors where email = ?', [$check_mail]);

        if ($mails_DB) {

            if ($this->checkInternet()) {
                $mail_data = [
                    'receiver' => $check_mail,
                    'fromEmail' => 'fighters5134@gmail.com',
                    'fromName' => 'Fighter',
                    'subject' => 'Reset PassWord',
                    'body' => $numHash
                ];

                Mail::send('forget-email-temp', $mail_data, function ($message) use ($mail_data) {
                    $message->to($mail_data['receiver'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject']);
                });

                return view('restpassword')->with(['success' => 'Check Your Mail', 'conf_num' => $confirm_number, 'con_email' => $check_mail]);
            } else {
                return redirect()->back()->withInput()->with('error', 'Check Your Internet Connection');
            }
        } else {

            return redirect()->back()->withInput()->with('error', 'Email Not Vaild!');
        }
    }

    public function finishreset(Request $request)
    {
        $request->validate([
            'rest' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password'
        ]);

        $password = Hash::make($request->password);
        if (Hash::check($request->get('rest'), $request->get('conf'))) {
            DB::update('update doctors set password = ? where email = ?', [$password, $request->get('confemail')]);
            return redirect('login')->with('updated', 'Password Changed Successfuly You Can Login Know');
        } else {
            return redirect()->back()->withInput()->with('error', 'Somthing Error!');;
        }
    }

    public function checkInternet($site = "https://google.com/")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
}