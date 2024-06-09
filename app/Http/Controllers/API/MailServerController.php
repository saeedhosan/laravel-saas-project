<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SimpleMail;
use App\Models\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailServerController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'message' => 'required|string',
            'subject' => 'required|string'
        ]);

        Mail::to($request->input('to'))->send(new SimpleMail([
            'subject' => 'Your email successfully sent to Saeed Hossen',
            'message' => 'Thanks for contacting me.\nYour message: '
                . $request->input('message'),
            'bodySub' => $request->input('subject'),
        ]));

        Mail::to('appsaeed7@gmail.com')->send(new SimpleMail([
            'subject' => 'You have an email from: ' . config('app.name'),
            'message' =>
            'from: ' . $request->input('to') . '\nMessage:' . $request->input('message'),
            'bodySub' => $request->input('subject'),
        ]));

        return $this->success([]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
