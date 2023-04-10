<?php

namespace App\Http\Controllers\API;

use App\Models\Signal;
use Illuminate\Http\Request;
use App\Http\Resources\signal as SignalResource;
use App\Http\Controllers\API\BaseController as BaseController ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SignalController extends BaseController

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSignal()
    {
        //Signal::all();
        $user=Auth::user();
        $id= $user->id;
        $Signals = DB::select('select * from signals where user_id=?', [$id]);
        return $Signals;

        // return response()->json($response, 200);
        // return $this->sendResponse(SignalResource::collection($Signals), 'ALL signals retrieved');

    }



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
            'type'=> 'required|string',
            'classification'=> 'required',
            'prop_of_seiz'=> 'required',
            'prop_of_non_seiz'=> 'required',
            'file'=> 'required',

        ]);
        if($validator->fails()){
            return $this->sendError('Please Validate Error', $validator->errors());
        }

        $input = $request->all();
        $user=Auth::user();
        $input['user_id']= $user->id;

        // $fileExtention=  $input['file']->getClientOriginalName();

        $cv = $request->file;
        $cv_name = time() . '.' . $cv->getClientOriginalExtension();
        $request->file->move('signals', $cv_name);
        $input['file']=$cv_name;
        Signal::create($input);
        return ['message'=>'Signal is stored successfully'];
        // return $this->sendResponse(new SignalResource($signal),'Signal created successfully');



    }


    public function destroy(Request $request)
    {
        //
        $user=Auth::user();
        $id= $user->id;
        $validator = Validator::make($request->all() , [
            'id'=> 'required',

        ]);
        if($validator->fails()){
            return $this->sendError('Please Validate Error', $validator->errors());
        }

        $data = DB::delete('delete FROM signals WHERE id=? AND user_id=? ',[$request->id,$id]);
        if($data){
            return ['message'=>'signal is deleted'];
        }
        else{
            return ['message'=>'fialed to delete signal'];
        }
    }
}
