<?php
namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\API\BaseController as BaseController ;
use App\Http\Resources\connection as ResourcesConnection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\connection;
use Illuminate\Http\Request;

class ConnectionsController extends BaseController
{

    // list of connections show function
    public function getConnection()
    {
        $id= Auth::guard('doctor')->user()->id;
        $axcept=1;
        $connectionsData = DB::select('select connections.id, user_id ,firstName, lastName, national_id, email, phone,city,country,
        connections.created_at, connections.updated_at FROM connections JOIN users ON(connections.user_id = users.id) AND axcept=? AND doctor_id=? ORDER BY connections.id ',[$axcept,$id]);

        if ($connectionsData) {
            // session(['connections' => $data]);
            return view('list_of_connections', compact('connectionsData'));
        } else {
            // session(['msg' => 'There is No connection with you!']);
            $CONmsg='There Are No connections with you!';
            // $connectionsData=false;
            return view('list_of_connections', compact('CONmsg','connectionsData'));
        }

    }

     // list of request show function
     public function Requested()
     {

         $id= Auth::guard('doctor')->user()->id;
         $axcept=0;
         $dataRequest = DB::select('select connections.id, user_id ,firstName, lastName, national_id, email, phone,city,country,
         connections.created_at FROM connections JOIN users ON(connections.user_id = users.id) AND doctor_id=? AND axcept=? ORDER BY connections.id ',[$id, $axcept]);

         if ($dataRequest) {
            //  session(['Request' => $dataRequest]);
             return view('connectionsRequested', compact('dataRequest'));
         } else {
            //  session(['msg' => 'There Are No Requests Sending!']);
             $RequestMsg='There Are No Requests Sending!';
             return view('connectionsRequested', compact('RequestMsg','dataRequest'));
         }

     }


    // cancel the request of connection
    public function cancel($id){
        $axcept=0;
        $data = DB::delete('delete FROM connections WHERE connections.id=? AND axcept=? ',[$id, $axcept]);
        if ($data)
        {
            return back()->with('success','request is canceled successflly');
        }
        else
        {
            return back()->with('fail', 'Something wrong');
        }

    }

    // delete the connection with patient
    public function delete($id){
        $axcept=1;
        $data = DB::delete('delete FROM connections WHERE connections.id=? AND axcept=? ',[$id, $axcept]);
        if ($data)
        {
            return back()->with('success','connection is deleted successflly');
        }
        else
        {
            return back()->with('fail', 'Something wrong');
        }

    }

    // search about patient
    public function search(Request $request){
        $request->validate([
            'national_id'=> 'required',
        ]);
        $docId=Auth::guard('doctor')->user()->id;
        $data = DB::select('select id, firstName, lastName, national_id, email, phone from users where national_id=?',[$request->national_id]);
        if($data){
            $con=DB::select('select id, user_id, doctor_id, axcept from connections where user_id=? AND doctor_id=?',[$data[0]->id,$docId]);
            if($con && $con[0]->axcept==1){
                return redirect('View/'. $data[0]->id);
            }
            elseif($con && $con[0]->axcept==0){
                // return redirect('connectionsRequest');
                $conID=$con[0]->id;
                return back()->with(['patientReject'=> 'You send request before but not Accept yet, please wait the patient  will accept your Request soon OR Cancel the Request', 'conID' => $conID, 'patient' => $data]);
            }
            return back()->with(['patient' => $data]);

        }
        else{ return back()->with(['patientError'=> 'there isn\'t user with this national ID!'])->withInput(); }

    }

    // send request to patient to access his data
    public function sendRequest($user_id)
    {
        $input['user_id']=$user_id;
        $input['doctor_id']=Auth::guard('doctor')->user()->id;
        $input['accept']=0;
        $RD= DB::select('select id from connections where user_id = ?', [$user_id]);
        if($RD){
            return back()->with(['PatientMessage' => 'Can\'t Send Request, YOU Are Send Before']);
        }
        connection::create($input);
        return back()->with(['PatientMessage' => 'wait the patient  will accept your Request soon']);
    }


}
