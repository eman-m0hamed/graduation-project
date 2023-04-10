<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController ;
use App\Http\Resources\symptom_user as symptom_userResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\symptom_user;
use App\Models\Symptom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class symptom_userController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsymptom()
    {
        $user=Auth::user();
        $id= $user->id;
        $data = DB::select('select et_1, et_2, et_3, et_4, et_5, et_6, created_at from symptom_users where user_id=? ORDER BY id DESC', [$id]);

        return $data;
        // if($data){
            // $response = [
            //     'success' => true,
            //     'data' =>   $data,
            //     'message' => 'ALL Symptoms are retrieved',
            // ];
            // return $data;
        // }
        // else{
            // $response = [
            //     'success' => false,
            //     'message' => 'there aren\'t Symptoms ',
            // ];
            // return 'there aren\'t Symptoms ';
        // }
        // return response()->json($response, 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all() , [
            'et_1'=> 'required|string',
            'et_2'=> 'required|string',
            'et_3'=> 'required|string',
            'et_4'=> 'required|string',
            'et_5'=> 'required|string',
            'et_6'=> 'required|string',

        ]);
        if($validator->fails()){
            return $this->sendError('Please Validate Error', $validator->errors());
        }

        $input = $request->all();
        $user=Auth::user();
        $input['user_id']= $user->id;
        $symptom = symptom_user::create($input);
        return [
            'success'=>true,
            'message'=>'symptoms created successfully'
        ];
    }


    public function update(Request $request)
    {
        $user=Auth::user();
        $users_id= $user->id;
        $input = $request->all();
        $validator = Validator::make($input , [
            'et_1'=> 'required|string',
            'et_2'=> 'required|string',
            'et_3'=> 'required|string',
            'et_4'=> 'required|string',
            'et_5'=> 'required|string',
            'et_6'=> 'required|string',

        ]);
        if($validator->fails()){
            return $this->sendError('Please Validate Error', $validator->errors());
        }
        $time = now()->toDateTimeString();
        $data= DB::update('update symptom_users set et_1 = ?, et_2 = ?, et_3 = ?, et_4 = ?, et_5 = ?, et_6 = ?, updated_at= ?
        where user_id = ?', [$request->et_1, $request->et_2, $request->et_3, $request->et_4, $request->et_5, $request->et_6, $time, $users_id]);

        if($data){
            return [
                'success'=>true,
                'message'=>'Symptoms Are updated'
            ];
        }
        else{
            return [
                'success'=>true,
                'message'=>'failed in updating Symptoms'
            ];

        }
    }


}
