<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::whereNotIn('id', [Auth::user()->id])->get(['id as key','name','email'])->toArray();
        return view('message',compact('data'));
    }

    public function send(Request $request) {
        $sender_id = Auth::user()->id;
        $receiver_id = $request->receiver_id;

        $message = new Message();
        $message->message = $request->message;

        if($message->save())
        {
            try {
                $message->users()->attach($sender_id, ['receiver_id' => $receiver_id]);
                $sender = User::where('id', $sender_id)->first()->toArray();
                $data = [];
                $data['sender_id'] = $sender_id;
                $data['sender_name'] = $sender['name'];
                $data['receiver_id'] = $receiver_id;
                $data['content'] = $message->message;
                $data['created_at'] = $message->created_at;
                $data['message_id'] = $message->id;

                return response()->json([
                    'data' => $data,
                    'success' => true,
                    'msg' => 'Message sent successfully',
                ]);
            } catch (\Throwable $th) {
                $message->delete();
            }
        }


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
