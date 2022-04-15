<?php

namespace App\Http\Controllers;

use App\Models\Totalcategory;
use App\Http\Requests\StoreTotalcategoryRequest;
use App\Http\Requests\UpdateTotalcategoryRequest;

class TotalcategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreTotalcategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTotalcategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Totalcategory  $totalcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Totalcategory $totalcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Totalcategory  $totalcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Totalcategory $totalcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTotalcategoryRequest  $request
     * @param  \App\Models\Totalcategory  $totalcategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTotalcategoryRequest $request, Totalcategory $totalcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Totalcategory  $totalcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Totalcategory $totalcategory)
    {
        //
    }
}
