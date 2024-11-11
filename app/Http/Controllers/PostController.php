<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepostRequest $request)
    {
        $post = request('post');

        post::create([
            'post' => $post,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(['message' => 'post created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        if($post->user_id == Auth::user()->id)
        {
            return response()->json([
                'post' => $post,
                'post_owner' => true
            ]);
        }

        else
        {
            return response()->json([
                'post' => $post,
                'post_owner' => false
            ]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepostRequest $request, post $post)
    {
        $updatedpost = $request->post;
        $post->post = $updatedpost;
        $post->safe();

        return response()->json
        ([
            'message' => 'post updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();
        
        return response()->json([
            'message' => 'post deleted'
        ]);
    }
}
