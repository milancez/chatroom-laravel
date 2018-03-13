<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show chats
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$users = User::All();
		return view('chat', compact('users'));
	}

	/**
	 * Fetch all messages
	 *
	 * @return Message
	 */
	public function fetchMessages() {
		return Message::with('user')->get();
	}

	/**
	 * Persist message to database
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function sendMessage(Request $request) {
		$user = Auth::user();

		$message = $user->messages()->create([
			'message' => $request->input('message'),
		]);

		//$message = $request->input('message');

		/*$message = new Message(array(
			'message' => $request->input('message'),
			//'user_id' => $user->id,
			'user_name' => $user->name
		));


		$message->save();*/

		broadcast(new MessageSent($user, $message))->toOthers();

		return ['status' => 'Message Sent!'];
	}
}
