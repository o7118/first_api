<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;

class pagecontroller extends Controller
{
    public function homepage()
    {
        $post = post::with('user')->get();
        return response()->json(['hello'=>'yaro', 'post'=>$post]);
    }
}
