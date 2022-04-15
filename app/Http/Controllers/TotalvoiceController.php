<?php

namespace App\Http\Controllers;

use App\Models\Totalvoice;
use App\Http\Requests\StoreTotalvoiceRequest;
use App\Http\Requests\UpdateTotalvoiceRequest;

class TotalvoiceController extends Controller
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
     * @param  \App\Http\Requests\StoreTotalvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTotalvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Totalvoice  $totalvoice
     * @return \Illuminate\Http\Response
     */
    public function show(Totalvoice $totalvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Totalvoice  $totalvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Totalvoice $totalvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTotalvoiceRequest  $request
     * @param  \App\Models\Totalvoice  $totalvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTotalvoiceRequest $request, Totalvoice $totalvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Totalvoice  $totalvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Totalvoice $totalvoice)
    {
        //
    }
}
