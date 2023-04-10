<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class adminController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',


        ]);

        $remember = request()->has('remember') ? true : false;
        $credentials = request(['email', 'password']);
        if (!Auth::guard('admin')->attempt($credentials)) {
            return back()->with(['error' => 'You Are Not Admin'])->withInput();
        }
        $profileData = DB::select('select id, name, email, password, created_at, updated_at from admins where email = ?', [$request->email]);
        session()->regenerate();
        session([
            'adminLogin' => true,
            'myProfile' => $profileData[0],

        ]);

        return redirect('admin');
    }

    public function accountRequest()
    {
        $DocRequest = DB::select('select * from doctors where active = ?', [0]);
        if ($DocRequest) {
            return view('admin.AdminDashboard', compact('DocRequest'));
        } else {
            $RequestMsg = 'There is No Account Request to Approve In This System!';
            return view('admin.AdminDashboard', compact('RequestMsg', 'DocRequest'));
        }
    }

    public function doctorsData(Request $request)
    {

        $doctors = DB::select('select * from doctors where active = ?', [1]);
        if ($doctors) {
            return view('admin.doctorsData', compact('doctors'));
        } else {
            $message = 'There is No Doctor In This System!';
            return view('admin.doctorsData', compact('message', 'doctors'));
        }
    }


    public function patientsData()
    {
        $patient_data = DB::select('select * from users');
        if ($patient_data) {
            return view('admin.patientsData', compact('patient_data'));
        } else {
            $message = 'There is No patient In This System!';
            return view('admin.patientsData', compact('message', 'patient_data'));
        }
    }
    public function signalsData()
    {
        $signals = DB::select('select signals.* , users.firstName, users.lastName from signals inner JOIN users on signals.user_id=users.id;');

        if ($signals) {
            return view('admin.signalsData', compact('signals'));
        } else {
            $message = 'There is No Signals In This System!';
            return view('admin.signalsData', compact('message', 'signals'));
        }
    }


    public function symptomsData()
    {
        $symptoms = DB::select('select symptom_users.* , users.firstName, users.lastName from symptom_users inner JOIN users on symptom_users.user_id=users.id;');
        if ($symptoms) {
            return view('admin.symptomsData', compact('symptoms'));
        } else {
            $message = 'There is No symptoms In This System!';
            return view('admin.symptomsData', compact('message', 'symptoms'));
        }
    }
    public function connectionsRequested()
    {
        $conREQ = DB::select('select connections.* , users.firstName, users.lastName, doctors.name from connections inner join users on connections.user_id = users.id inner JOIN doctors on connections.doctor_id=doctors.id where axcept = 0;');
        if ($conREQ) {
            return view('admin.connectionsRequested', compact('conREQ'));
        } else {
            $message = 'There is No Requested In This System!';
            return view('admin.connectionsRequested', compact('message', 'conREQ'));
        }
    }
    public function connections()
    {
        $conns = DB::select('select connections.* , users.firstName, users.lastName, doctors.name from connections inner join users on connections.user_id = users.id inner JOIN doctors on connections.doctor_id=doctors.id where axcept = 1;');
        if ($conns) {

            return view('admin.connectionsData', compact('conns'));
        } else {
            $message = 'There is No Connections In This System!';
            return view('admin.connectionsData', compact('message', 'conns'));
        }
    }

    public function logOut()
    {
        session()->flush();
        return redirect('adminLogin');
    }

    public function acceptAcount($id)
    {
        $data = DB::update('update doctors set active = 1 where id = ?', [$id]);
        if ($data) {
            $doc = DB::select('select email, name from doctors where id = ?', [$id]);
            if ($this->checkInternet()) {
                $email = $doc[0]->email;
                $mail_data = [
                    'receiver' => $email,
                    'fromEmail' => 'fighters5134@gmail.com',
                    'fromName' => 'Fighter Team',
                    'subject' => 'Approving Account',
                    'body' => 'Hello Dear: ' . $doc[0]->name . ' We want to tell you that we review your data and accept your account you can now logIn to our System by click on this link: http://epilepsy.novel-eg.com/public/login',

                ];
                Mail::send('admin.email-approve-temp', $mail_data, function ($message) use ($mail_data) {
                    $message->to($mail_data['receiver'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject']);
                });
                return back()->with('success', 'Account is Approved successflly');
            } else {
                return back()->with('fail', 'Account is Approved successflly but Failed in Sending Approved Email');
            }
        } else {
            return back()->with('fail', 'Something Wrong in Approving Account');
        }
    }

    public function deleteAcount($id)
    {
        $doc = DB::select('select email, name from doctors where id = ?', [$id]);
        $data = DB::delete('delete FROM doctors WHERE id=?', [$id]);
        if ($data) {
            if ($this->checkInternet()) {
                $email = $doc[0]->email;
                $mail_data = [
                    'receiver' => $email,
                    'fromEmail' => 'fighters5134@gmail.com',
                    'fromName' => 'Fighter Team',
                    'subject' => 'Rejecting Account',
                    'body' => 'Hello Dear: ' . $doc[0]->name . ' We want to tell you that we review your data and sorry to tell you you that your account are rejected',

                ];
                Mail::send('admin.email-approve-temp', $mail_data, function ($message) use ($mail_data) {
                    $message->to($mail_data['receiver'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject']);
                });
                return back()->with('success', 'Account is Approved successflly');
            }
            return back()->with('success', 'Account is Deleted successflly');
        } else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function deletePatient($id)
    {

        $data = DB::delete('delete FROM users WHERE id=?', [$id]);
        if ($data) {
            return back()->with('success', 'Patient Data is Deleted successflly');
        } else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function deleteSignal($id)
    {

        $data = DB::delete('delete FROM signals WHERE id=?', [$id]);
        if ($data) {
            return back()->with('success', 'Signal is Deleted successflly');
        } else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function deleteConnection($id)
    {

        $data = DB::delete('delete FROM connections WHERE id=? AND axcept=1', [$id]);
        if ($data) {
            return back()->with('success', 'Connection is Deleted successflly');
        } else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function deleteRequest($id)
    {

        $data = DB::delete('delete FROM connections WHERE id=? AND axcept=0', [$id]);
        if ($data) {
            return back()->with('success', 'Connection Request is Deleted successflly');
        } else {
            return back()->with('fail', 'Something wrong');
        }
    }

    public function deleteSymptom($id)
    {

        $data = DB::delete('delete FROM symptom_users WHERE id=?', [$id]);
        if ($data) {
            return back()->with('success', 'Patient Symptoms is Deleted successflly');
        } else {
            return back()->with('fail', 'Something wrong');
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

    public function selectPatient($id)
    {
        $patient_data = DB::select('select * from users where id=?', [$id]);
        // if ($patient_data) {
        //     return view('admin.patientsData', compact('patient_data'));
        // } else {
        //     $message = 'There is No patient In This System!';
        //     return view('admin.patientsData', compact('message', 'patient_data'));
        // }

        if ($patient_data) {
            return redirect('patient')->with($patient_data);
        } else {
            $message = 'There is No patient In This System!';
            return redirect('patient')->with($message, $patient_data);
        }
    }
    public function displaycv($id)
    {
        $cvs = DB::select('select profession_permit from doctors where id=?', [$id]);
        // return response()->download(public_path('CVs/' . $cvs[0]->profession_permit));
        return view('cv', compact('cvs'));
    }

    public function displaySignal($sigId)
    {
        $file = DB::select('select file from signals where id=?', [$sigId]);
        // return response()->download(public_path('CVs/' . $cvs[0]->profession_permit));
        return view('signal', compact('file'));
    }
}