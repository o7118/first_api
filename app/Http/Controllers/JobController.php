<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Http\Requests\StorejobRequest;
use App\Http\Requests\UpdatejobRequest;
use App\Models\joblisting;

class JobController extends Controller
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
    public function store(StorejobRequest $request)
    {
        return response()->json([
            'meaasge' => 'job created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(joblisting $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(joblisting $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejobRequest $request, joblisting $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(joblisting $job)
    {
        //
    }
}
