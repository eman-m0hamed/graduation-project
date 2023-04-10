<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Signal;
use Illuminate\Http\Request;
use App\Http\Resources\Patient as PatientResource;
use App\Http\Resources\signal as SignalResource;
use App\Http\Controllers\API\BaseController as BaseController ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class PatientController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $patients = User::all();
        // $patients['password'] = decrypt($patients['password']);

        $user=Auth::user();
        $id= $user->id;
        $patient = User::where('id', $id)->get();

        return $this->sendResponse(PatientResource::collection($patient), 'ALL Patient data sent');

    }


    function getPatient($id){
        $patients = User::all();
        // $patients['password'] = decrypt($patients['password']);

        foreach($patients as $patient){
            if($patient['id']==$id){
               return $patient;
            }
        }
        return null;
    }

    function show(){
        $user=Auth::user();
        $id= $user->id;
        $patientData= $this->getPatient($id);
        if($patientData == null){
            return [
                'success' => false,
                'message' => "No such user with id = $id"
            ];
        }

        return[
            'success' => true,
            'data'=> $patientData,
        ];

    }


    public function update(Request $request)
    {

        $user=Auth::user();
        $id= $user->id;

        $validator = Validator::make($request->all() , [
            'firstName'=> 'required|string',
            'lastName'=> 'required|string',
            'email'=> 'required|email',
            'city'=> 'required',
            'country'=> 'required',
            'gender'=> 'required',
            'national_id'=> 'required',
            'phone'=> 'required',
            'birth_day'=>'required',

        ]);
        if($validator->fails()){
            return $this->sendError('Please Validate Error', $validator->errors());
        }
        // $patient->email= $input['email'];
        // $patient[$id]->update($request->all());
        // $password= Hash::make($request->password);
        $time = now()->toDateTimeString();
        $data= DB::update('update users set firstName = ?, lastName = ?,  email=?, gender=?, birth_day=?, city=?, country=?, phone=?, national_id=?, updated_at= ?
        where id = ?', [$request->firstName, $request->lastName, $request->email, $request->gender, $request->birth_day, $request->city, $request->country, $request->phone, $request->national_id, $time, $id]);
        if($data){
            return 'data is updated';
        }
        else{
            return 'failed in updating profile';
        }

    }

    public function logOut(Request $request){
        Auth::logout();
        $request->user()->tokens()->delete();
        return response()->json([
            'message'=>'logged Out'
        ]);
    }


}
