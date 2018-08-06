<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Registrationimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Purifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function newClient(Request $request) {
        $msg = "";

        $moduleitem = new Registration();
        //insert modules            
        $moduleitem->fname = Purifier::clean($request['firstname']);
        $moduleitem->lname = Purifier::clean($request['surname']);
        $moduleitem->oname = "";//Purifier::clean($request['oname']);
        $moduleitem->states = "abuja";//$request['states'];
        $moduleitem->phone = Purifier::clean($request['phone']);
        $moduleitem->email = trim($request['email']);
        $moduleitem->validated = 'no';
        $client_dob = ($request['dob']) ? ($request['dob']) : (date('m/d/Y'));
        $moduleitem->dob = date('Y-m-d', strtotime($client_dob));

        $moduleitem->employer = Purifier::clean($request['employer']);
        $moduleitem->save();
        $msg.= " Your registration was successful, one of our agents will contact you. thank you ";

        // Check if we've uploaded a file
        if (!empty($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $moduleimage = new Registrationimage();
            $maxsize    = 2097152;
            // Be sure we're dealing with an upload
            if (is_uploaded_file($_FILES['file']['tmp_name']) === false) {
                return 'Error on upload: Invalid file definition';
            }
            //chk extension
            $allowed = array('gif', 'png', 'jpg', 'jpeg');
            $filename = $_FILES['file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                return 'Invalid file uploaded';
            }
            //chk file size
            if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                return 'File too large. File must be less than 2 megabytes.';
            }
            //rename & move file
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);

            $target_path = public_path('/site/img/');
            $target_path = $target_path . $newfilename;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                $msg .= " and image upload successful ";
            } else {
                $msg .= "but there was an error uploading the file. ";
            }
            //save the image                
            $moduleimage->filename = $newfilename;
            $moduleimage->itemid = $moduleitem->id;
            $moduleimage->save();
        }
        return $msg;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        //
    }
}
