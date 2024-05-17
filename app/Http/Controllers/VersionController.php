<?php

namespace App\Http\Controllers;

use App\Models\Version;
use App\Http\Requests\StoreVersionRequest;
use App\Http\Requests\UpdateVersionRequest;

class VersionController extends Controller
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
    public function store(StoreVersionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Version $version)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Version $version)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVersionRequest $request, Version $version)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Version $version)
    {
        //
    }
}
