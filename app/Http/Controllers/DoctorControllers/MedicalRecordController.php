<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\connection;
use App\Models\note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MedicalRecordController extends BaseController
{

    // list of connections show function
    public function showMedicalRecord($patient_id)
    {
        if ($patient_id > 0) {

            $personalData = DB::select('select id, firstName, lastName, national_id, email, phone, city, country, gender, birth_day
            FROM users where id=?', [$patient_id]);

            $SignalData = DB::select('select id, type, classification, prop_of_seiz, prop_of_non_seiz, created_at,file FROM signals where user_id=?', [$patient_id]);

            $SymptomData = DB::select('select id, et_1, et_2, et_3, et_4, et_5, et_6, created_at, updated_at FROM symptom_users where user_id=?', [$patient_id]);
            $notes = DB::select('select notes.*, name, email from notes inner JOIN doctors on notes.doctor_id=doctors.id where user_id = ?', [$patient_id]);
            if ($SymptomData) {
                session(['SymptomData' => $SymptomData]);
            } else {
                session(['SymMsg' => 'There is No Symptom recorded to this patient']);
            }

            if ($SignalData) {
                session(['SignalData' => $SignalData]);
            } else {
                session(['SigMsg' => 'There is No signal recorded to this patient']);
            }


            if ($personalData) {
                session(['personalData' => $personalData]);
            } else {
                session(['PerMsg' => 'There is No patient with this id!']);
            }

            if ($notes) {
                session(['notes' => $notes]);
            } else {
                session(['noteMsg' => 'There is No Notes recorded to this patient']);
            }

            return redirect('medicalRecord');
        } else {
            return back()->with('fail', "There is no Patient with this data");
        }
    }


    public function addNote(Request $request)
    {
        $request->validate([
            'note' => 'required|string',
            'user_id' => 'required',
        ]);

        $id = Auth::guard('doctor')->user()->id;
        $input = $request->all();
        $input['doctor_id'] = $id;
        $data = note::create($input);
        $notes = DB::select('select notes.*, name, email from notes inner JOIN doctors on notes.doctor_id=doctors.id where user_id = ?', [$request->user_id]);
        session(['notes' => $notes]);
        if ($data) {

            return back()->with(['noteMessage' => 'Note is Added successfully']);
        } else {
            return back()->with(['error' => 'Unexpected Erorr happended during adding note']);
        }
    }

    public function upload(Request $request)
    {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
        ])->asForm()->post('https://seizure-model-connection.herokuapp.com/EEG', [
            'file' => $request->file('file')
        ]);
        dd($response);
    }
    public function displaySignals($sigId)
    {
        $file = DB::select('select file from signals where id=?', [$sigId]);
        // return response()->download(public_path('CVs/' . $cvs[0]->profession_permit));
        return view('signal', compact('file'));
    }
}