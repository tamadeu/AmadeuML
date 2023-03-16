<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index() {
        $userId = Auth::user()->id;

        $chats = DB::table('chats')
                ->select('id', 'title', 'avatar', 'updated_at')
                ->where('user', $userId)
                ->groupBy('id')
                ->orderBy('updated_at', 'asc')
                ->get();
    
    
        return view('index', [
            'chats' => $chats,
            'chat_name' => env('APP_NAME')
            ]);
    }
}
