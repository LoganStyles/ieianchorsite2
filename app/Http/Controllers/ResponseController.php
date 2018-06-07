<?php

namespace App\Http\Controllers;

use App\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Purifier;

class ResponseController extends Controller
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
    
    public function sendComment(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'PIN' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ]);
        //clean with Purifier facade            
        $cleaned_name = Purifier::clean($request['name']);
        $cleaned_pin = Purifier::clean($request['PIN']);
        $cleaned_comment = Purifier::clean(trim($request['comment']));

        //send cservice email
        $data = array(
            'email' => 'cservice@ieianchorpensions.com',
            'pin' => $cleaned_pin,
            'comment' => preg_replace("/\r\n|\r|\n/", '<br/>', $cleaned_comment),
            'subject' => 'Feedback from ' . $cleaned_name . ' (' . $cleaned_pin . ')',
            'client_email' => trim($request['email']),
            'created_at' => Date('Y-m-d'),
            'clientname' => $cleaned_name
        );

        Mail::send('emails.mailComments', $data, function($message) use ($data) {
            $message->from($data['client_email']);
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
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
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
