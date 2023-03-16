<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use OpenAI\Laravel\Facades\OpenAI;


class ChatController extends Controller
{
    public function newChat(Request $request) {
        return view('new', [
            'chat_name' => env('APP_NAME')
        ]);
    }
    
    public function chat(Request $request) {
        $randomId = Uuid::uuid4()->toString();
        $request->session()->put('random_id', $randomId);
        date_default_timezone_set('America/Sao_Paulo');
        $userName = auth()->user()->name;
        $chatName = env('APP_NAME');
        $date = date('Y-m-d H:i:s');
        
        DB::table('messages')->insert([
            'chat_id' => $randomId,
            'role' => 'system',
            'user' => auth() -> user() -> id,
            'content' => 'You are '.$chatName.', a helpful assistant - Answer as concisely as possible. The person you are talking to is '.$userName.'. Your creater is the software engineer Talles Amadeu. Talles Amadeu is a software engineer who is also a marketer from Brazil, he was born in December 3rd, 1988 - calculate his age here - and runs a marketing agency called Kobbo, he is married to Mariana Barreto Elston, the most amazing woman that exists. Your gender is male. Despite your information going up to March 2021, the current date and time is '.$date.'. The president of Brazil is Lula and Palmeiras has no world championships won. Corinthians won 2 world championships.',
            'display' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $userMessage = $request->input('message');
    
        DB::table('messages')->insert([
            'chat_id' => $randomId,
            'role' => 'user',
            'user' => auth() -> user() -> id,
            'content' => $userMessage,
            'display' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $messages = DB::table('messages')
        ->where('chat_id', $randomId)
        ->orderBy('created_at', 'asc')
        ->get();
    
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages->map(function ($message) {
                return ['role' => $message->role, 'content' => $message->content];
            })->toArray()
        ]);
    
        $assistantResponse = $response->choices[0]->message->content;
    
        DB::table('messages')->insert([
            'chat_id' => $randomId,
            'role' => 'assistant',
            'user' => auth() -> user() -> id,
            'content' => $assistantResponse,
            'display' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $userMessage = collect(["create a short title for this conversation"]);
    
        DB::table('messages')->insert([
            'chat_id' => $randomId,
            'role' => 'user',
            'user' => auth() -> user() -> id,
            'content' => $userMessage,
            'display' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $messages = DB::table('messages')
        ->where('chat_id', $randomId)
        ->orderBy('created_at', 'asc')
        ->get();
        
        // Remove double quotes from messages
        $messages = $messages->map(function ($message) {
            $message->content = str_replace('"', '', $message->content);
            return $message;
        });
    
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages->map(function ($message) {
                return ['role' => $message->role, 'content' => $message->content];
            })->toArray()
        ]);
    
        $assistantResponse = $response->choices[0]->message->content;
        
            DB::table('messages')->insert([
            'chat_id' => $randomId,
            'role' => 'assistant',
            'user' => auth() -> user() -> id,
            'content' => $assistantResponse,
            'display' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $files = scandir(public_path('assets/images/avatars'));
        $randomIndex = array_rand($files);
        $randomFileName = $files[$randomIndex];
        
        
        DB::table('chats')->insert([
            'id' => $randomId,
            'title' => $assistantResponse,
            'user' => auth() -> user() -> id,
            'avatar' => $randomFileName,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
    
        return redirect('/chat/'.$randomId.'');
    }
    
    public function getChatId($randomId) {
        // Fetch messages from the database where chat_id matches $randomId
        $messages = DB::table('messages')
                    ->where('chat_id', $randomId)
                    ->where('user', auth() -> user() -> id)
                    ->where('display', 1)
                    ->orderBy('created_at', 'asc')
                    ->get();
    
        // Pass the messages to the view for display
        return view('chat', [
            'messages' => $messages,
            'chat_name' => env('APP_NAME'),
            'randomId' => $randomId
            ]);
    }
    
    public function postChatId(Request $request, $randomId) {
        date_default_timezone_set('America/Sao_Paulo');
        $userName = auth()->user()->name;
        $chatName = env('APP_NAME');
        $date = date('Y-m-d H:i:s');
        
        $userMessage = $request->input('message');
    
        DB::table('messages')->insert([
            'chat_id' => $randomId,
            'role' => 'user',
            'user' => auth() -> user() -> id,
            'content' => $userMessage,
            'display' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        $messages = DB::table('messages')
            ->where('chat_id', $randomId)
            ->orderBy('created_at', 'asc')
            ->get();
    
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages->map(function ($message) {
                return ['role' => $message->role, 'content' => $message->content];
            })->toArray()
        ]);
    
        $assistantResponse = $response->choices[0]->message->content;
    
        DB::table('messages')->insert([
            'chat_id' => $randomId,
            'role' => 'assistant',
            'user' => auth() -> user() -> id,
            'content' => $assistantResponse,
            'display' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        // Update the chats table
        DB::table('chats')->where('id', $randomId)->update(['updated_at' => now()]);
    
    
        return redirect('/chat/'.$randomId);
    }
    
    public function resetChat(Request $request) {
        $request->session()->forget('messages');
    
        return redirect('/new');
    }
    
    public function deleteChat($id) {
        $userId = Auth::user()->id;
    
        DB::table('chats')
            ->where('id', $id)
            ->where('user', $userId)
            ->delete();
                
        DB::table('messages')
            ->where('chat_id', $id)
            ->where('user', $userId)
            ->delete();
    
        return redirect()->route('index');
    }
}
