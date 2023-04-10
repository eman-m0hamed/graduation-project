<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\connection;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Resources\Connection as ConectionResource;
use App\Http\Controllers\API\BaseController as BaseController ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ConnectionController extends BaseController

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConnection()
    {
        //
        $user=Auth::user();
        $id= $user->id;
        $axcept=1;
        $data = DB::select('select connections.id, doctor_id,name, address, phone, connections.created_at FROM connections JOIN doctors ON(connections.doctor_id = doctors.id) AND user_id=? AND axcept=?',[$id, $axcept]);
        return $data;
            // $response = [
            //     'success' => true,
            //     'data' =>   $data,
            //     'message' => 'ALL connections are retrieved',
            // ];


        // return response()->json($response, 200);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function showRequest()
    {
        $user=Auth::user();
        $id= $user->id;
        $axcept=0;
        $data = DB::select('select connections.id, doctor_id,name, address, phone, connections.created_at FROM connections JOIN doctors ON(connections.doctor_id = doctors.id) AND user_id=? AND axcept=?',[$id, $axcept]);
        return $data;
            // $response = [
            //     'success' => true,
            //     'data' =>   $data,
            //     'message' => 'ALL Connection Requests are retrieved',
            // ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function rejectRequest(Request $connectionID)
    {
        //
        $connectionID->validate([
            'connectionId'=> 'required',


        ]);
        $data = DB::delete('delete FROM connections WHERE connections.id=? ',[$connectionID->connectionId]);

        if($data){
            $response = [
                'success' => true,
                'message' => 'request is rejected',
            ];
        }
        else{
            $response = [
                'success' => false,
                'message' => 'there is problem with reject',
            ];
        }
        return response()->json($response, 200);


    }


    public function acceptRequest(Request $connectionID)
    {

        $connectionID->validate([
            'connectionId'=> 'required',


        ]);
        $axcept=1;
        //
        $data = DB::update('update connections set axcept= ? WHERE connections.id=? ',[$axcept ,$connectionID->connectionId]);
        if($data){
            $response = [
                'success' => true,
                'message' => 'request is accepted',
            ];
        }
        else{
            $response = [
                'success' => false,
                'message' => 'there is problem with accepting request',
            ];
        }
        return response()->json($response, 200);


    }

    public function ConnectionDelete(Request $connectionID)
    {
        //
        $connectionID->validate([
            'connectionId'=> 'required',


        ]);
        $data = DB::delete('delete FROM connections WHERE connections.id=? ',[$connectionID->connectionId]);

        if($data){
            $response = [
                'success' => true,
                'message' => 'connection is deleted',
            ];
        }
        else{
            $response = [
                'success' => false,
                'message' => 'there is problem with delete',
            ];
        }
        return response()->json($response, 200);


    }

}
