<?php

namespace App\Http\Controllers;

use App\Models\Propose;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProposeRequest;
use App\Http\Requests\UpdateProposeRequest;

class ProposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreProposeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProposeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Propose  $propose
     * @return \Illuminate\Http\Response
     */
    public function show(Propose $propose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Propose  $propose
     * @return \Illuminate\Http\Response
     */
    public function edit(Propose $propose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProposeRequest  $request
     * @param  \App\Models\Propose  $propose
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProposeRequest $request, Propose $propose)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Propose  $propose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Propose $propose)
    {
        //
    }
}
