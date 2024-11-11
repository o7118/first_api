<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Http\Requests\StoreauthorRequest;
use App\Http\Requests\UpdateauthorRequest;
use App\Http\Resources\authorresource;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return authorresource::collection(author::all());
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
    public function store(Request $request)
    {
        if(request('name') != null){
            $john = author::create(['name' => request('name')]);
            return new authorresource($john);
        }
        else{
            return response()->json([
                'message' => 'name not found'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(author $author)
    {
        if($author){
            return new authorresource($author);
        }
        else{
            return response(null, ['message' => 'not found'])->json(['message' => 'user not found']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateauthorRequest $request, author $author)
    {
        $author->update([
            'name' => $request->input('name')
        ]);
        return new authorresource($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(author $author)
    {
        if($author != null){
            $author->delete();
            return response()->json([
                null, 204
        ]);
        }

        else{
            return response()->json([
                'message' => 'no record found'
            ]);
        }
        
    }
}
