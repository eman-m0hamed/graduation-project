<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorControllers\DoctorController;
use App\Http\Controllers\DoctorControllers\ContactUsController;
use App\Http\Controllers\DoctorControllers\ConnectionsController;
use App\Http\Controllers\DoctorControllers\MedicalRecordController;
use App\Http\Controllers\DoctorControllers\ForgetPasswordController;
use App\Http\Controllers\AdminControllers\adminController;
use App\Http\Resources\signal;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('admin', function () {
//     return 'test';
// })->middleware('AuthDoctor:doctor'); // middleware in kernal : guard


Route::group(['middleware' => 'AuthGuest'], function () {


    Route::get('/login', function () {
        return view('login');
    });

    Route::get('/register', function () {
        return view('register');
    });

    Route::post('login', [DoctorController::class, 'login']);
    Route::post('register', [DoctorController::class, 'register']);

    Route::get('/contact', function () {
        return view('contact');
    });

    Route::get('/forgetPassword', function () {
        return view('forget');
    });
    Route::post('resetPass', [ForgetPasswordController::class, 'restpass']);
    Route::post('finishReset', [ForgetPasswordController::class, 'finishreset']);

    Route::get('/adminLogin', function () {
        return view('admin.adminLogin');
    });

    Route::post('AdminLogin', [adminController::class, 'login']);
});


Route::middleware('AuthDoctor:doctor')->group(function () {
    Route::get('/', function () {
        return redirect('home');
    });

    Route::get('home', function () {
        return view('home');
    });

    Route::get('search', function () {
        return view('search');
    });

    Route::get('contactUs', function () {
        return view('contactUs');
    });

    Route::get('profile', function () {
        return view('prof_detail');
    });
    Route::get('editProfile', function () {
        return view('editProfile');
    });
    Route::post('updateProfile', [DoctorController::class, 'updateProfile']);
    // Route::get('contactUs',[DoctorController::class,'contactUs']);


    Route::get('connections', [ConnectionsController::class, 'getConnection']);
    Route::get('connectionsRequest', [ConnectionsController::class, 'Requested']);
    Route::get('View/{userId}', [MedicalRecordController::class, 'showMedicalRecord']);
    Route::get('connectionDelete/{conId}', [ConnectionsController::class, 'delete']);
    Route::get('requestCancel/{conId}', [ConnectionsController::class, 'cancel']);
    Route::post('search', [ConnectionsController::class, 'search']);
    Route::get('sendRecquest/{patientId}', [ConnectionsController::class, 'sendRequest']);
    Route::post('note', [MedicalRecordController::class, 'addNote']);
    Route::post('upload', [MedicalRecordController::class, 'upload']);
    Route::get('displaysignals/{sigId}', [MedicalRecordController::class, 'displaySignals']);

    Route::get('medicalRecord',  function () {
        return view('medicalRecord');
    });
    Route::get('emgUpload', function () {
        return view('emgUpload');
    });

    Route::get('eegUpload', function () {
        return view('eegUpload');
    });

    Route::post('emgResult', function () {
        return view('emgResult');
    });

    Route::get('logOut', [DoctorController::class, 'logOut']);
});

Route::post('send', [ContactUsController::class, 'send'])->name('send.email');

/* Start Admin Route*/
Route::middleware('AuthAdmin:Admin')->group(function () {

    Route::get('admin', [adminController::class, 'accountRequest']);
    Route::get('doctorData', [adminController::class, 'doctorsData']);
    Route::get('patientsData', [adminController::class, 'patientsData']);
    Route::get('signalsData', [adminController::class, 'signalsData']);
    Route::get('symptomsData', [adminController::class, 'symptomsData']);
    Route::get('connectionsRequested', [adminController::class, 'connectionsRequested']);
    Route::get('connection', [adminController::class, 'connections']);
    Route::get('AcceptAcount/{DocId}', [adminController::class, 'acceptAcount']);
    Route::get('CancelAccount/{DocId}', [adminController::class, 'deleteAcount']);
    Route::get('deletePatient/{Id}', [adminController::class, 'deletePatient']);
    Route::get('deleteSignal/{Id}', [adminController::class, 'deleteSignal']);
    Route::get('deleteConnection/{Id}', [adminController::class, 'deleteConnection']);
    Route::get('deleteRequest/{Id}', [adminController::class, 'deleteRequest']);
    Route::get('deleteSymptom/{Id}', [adminController::class, 'deleteSymptom']);
    Route::get('LogOut', [adminController::class, 'logOut']);
    Route::get('displaysignal/{sigId}', [adminController::class, 'displaySignal']);
    Route::get('patient/{id}', [adminController::class, 'selectPatient']);
    Route::get('patient',  function () {
        return view('admin.patientsData');
    });
    Route::get('displayCv/{id}', [adminController::class, 'displaycv']);
    // Route::get('cv',  function () {
    //     return view('cv');
    // });
});

/* End Admin Route */