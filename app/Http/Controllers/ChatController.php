<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private $chat;
    private $roomId;

    public function __construct()
    {
        $this->chat = app('Chat');
        $this->roomId = env('CHATKIT_GENERAL_ROOM_ID');
    }


    /*Returns welcome page if a user ID doesn't exist in the current session.
      else it redirects to the chat page.*/
    public function index(Request $request) 
    {
        $userid = $request->session()->get('chatkit_id')[0];

        if (!is_null($userid)) 
        {
            return redirect(route('chat'));
        }

        return view('app');
    }

    /*Creates a new user and adds the user to the chat.
      Saves the users ID in the current session beofre redirecting the user to the chat page. */
    public function join(Request $request) 
    {
        $chatkit_id = strtolower(str_random(5));

        $this->chat->createUser([
            'id' => $chatkit_id,
            'user-ids' => [$chatkit_id],
        ]);

        $this->chat->addUsersToRoom([
            'room_id' => $this->roomId,
            'user_ids' => [$chatkit_id],
        ]);
        
        $request->session()->push('chatkit_id', $chatkit_id);

        return redirect(route('chat'));
    }

    /*Handles chat page on browser load.
      Gets the current user ID from the session, if ID is not found, redirect user to the welcome page. */
    public function chat(Request $request) 
    {
        $roomId = $this->roomId;

        $userId = $request->session()->get('chatkit_id')[0];

        if (is_null($userId)) {
            $request->session()->flash('status', 'Join to access chat room!');

            return redirect(url('/'));
        }

        $fetchMessages = $this->chat->getRoomMessages([
            'room_id' => $roomId,
            'direction' => 'newer',
            'limit' => 100
        ]);

        $messages = collect($fetchMessages['body'])->map(function ($message) {
            return [
                'id' => $message['id'],
                'senderId' => $message['user_id'],
                'text' => $message['text'],
                'timestamp' => $message['created_at']
            ];
        });

        return view('chat')->with(compact('messages','roomId','userId'));
    }

    /*Token provider server that recieves the client's request and returns a valid JWT (JSON Web Token) to chat client.*/
    public function authenticate(Request $request) 
    {
        $response = $this->chat->authenticate([
            'user_id' => $request->user_id,
        ]);

        return response()
                ->json(
                    $response['body'],
                    $response['status']
                );
    }

    /*Use SDK's method to send message to chat room. */
    public function sendMessage(Request $request) 
    {
        $message = $this->chat->sendSimpleMessage([
            'sender_id' => $request->user,
            'room_id' => $this->roomId,
            'text' => $request->message
        ]);

        return response($message);
    }

    /*Returns all users created on chat instance. */
    public function getUsers() 
    {
        $users = $this->chat->getUsers();

        return response($users);
    }

    /*Flushes current session and redirects to the welcome page*/
    public function logout(Request $request) 
    {
        $request->session()->flush();

        return redirect(url('/'));
    }
}
