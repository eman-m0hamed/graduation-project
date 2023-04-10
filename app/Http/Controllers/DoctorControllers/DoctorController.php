<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends BaseController
{

    public function register(Request $request)
    {


        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:doctors',
            'password' => 'required|string|min:4',
            'address' => 'required|string',
            'phone' => 'required',
            'profession_permit' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = Doctor::create($input);

        $cv = $request->profession_permit;
        $cv_name = time() . '.' . $cv->getClientOriginalExtension();
        $request->profession_permit->move('CVs', $cv_name);

        DB::table('doctors')
            ->where('email', $request->email)
            ->update([
                'profession_permit' => $cv_name
            ]);

        if ($user) {
            return back()->with(['message' => 'Account Created successfully Wait the Admin will Approve Your Account']);
        } else {
            return back()->with(['error' => 'Unexpected Erorr happended during registration']);
        }
    }


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',


        ]);
        $remember = request()->has('remember') ? true : false;
        $credentials = request(['email', 'password']);
        if (!Auth::guard('doctor')->attempt($credentials)) {
            return back()->with(['error' => 'incorrect email or password'])->withInput();
        }
        $profileData = DB::select('select id, name, email, password, address, phone, active, created_at, updated_at from doctors where email = ?', [$request->email]);
        $active = $profileData[0]->active;
        if ($active) {
            session()->regenerate();
            session([
                'loggedIn' => true,
                'myProfile' => $profileData[0],
            ]);
            return redirect('home');
        }
        return back()->with(['message' => 'Please wait the Admin will Approve Your Account soon'])->withInput();
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required',
        ]);

        $id = Auth::guard('doctor')->user()->id;
        $time = now()->toDateTimeString();
        $data = DB::update('update doctors set name = ?, email = ?,  phone=?, address=?, updated_at=?
        where id = ?', [$request->name, $request->email, $request->phone, $request->address, $time, $id]);

        if ($data) {
            $profileData = DB::select('select id, name, email, password, address, phone, created_at, updated_at from doctors where email = ?', [$request->email]);
            session(['myProfile' => $profileData[0]]);

            return redirect('profile')->with('updatedProfile', 'Profile Data is updated Sucessfully');
        } else {
            return back()->with('failedProfile', 'Failed in Updating Profile ');
        }
    }


    public function logOut()
    {
        session()->flush();
        return redirect('login');
    }
}