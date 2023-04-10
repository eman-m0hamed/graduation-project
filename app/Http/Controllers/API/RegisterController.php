<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\doctor;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{


   public function register(Request $request){

    $validator = Validator::make($request->all() , [
        'firstName'=> 'required|string',
        'lastName'=> 'required|string',
        'email'=> 'required|email|unique:users',
        'password'=> 'required|string|min:4',
        'city'=> 'required|string',
        'country'=> 'required|string',
        'gender'=> 'required',
        'national_id'=> 'required|unique:users',
        'phone'=>'required',



    ]);
    if($validator->fails()){
        return $this->sendError('Please Validate Error', $validator->errors());
    }


    $input = $request->all();
    $input['password'] = Hash::make($input['password']);

    $user = User::create($input);
    $success['token']= $user->createToken('personal access token')->accessToken;
    $success['Name'] =  $user->firstName.' '.$user->lastName;
    return $this->sendResponse($success,'User registered successfully');

   }


   public function login(Request $request){

        $validator = Validator::make($request->all() , [
            'email'=> 'required|email',
            'password'=> 'required|string|min:4',


        ]);
        if($validator->fails()){
            return $this->sendError('Please Validate Error', $validator->errors());
        }
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return $this->sendError('please check your Auth', ['error'=>'Unauthorized']);
        }

        // $user= Auth::user();
        $user =$request->user();
        $success['token']= $user->createToken('personal access token')->accessToken;
        $success['Name'] =  $user->firstName.' '.$user->lastName;

        return $this->sendResponse($success,'User login successfully');

    }





}



