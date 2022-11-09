<?php

namespace App\Http\Controllers;

use App\Models\MuayThaiClass;
use Illuminate\Http\Request;

class MuayThaiClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = MuayThaiClass::all();
        return view('muay_thai_class.index', ['classes' => $classes]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MuayThaiClass  $muayThaiClass
     * @return \Illuminate\Http\Response
     */
    public function show(MuayThaiClass $muayThaiClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MuayThaiClass  $muayThaiClass
     * @return \Illuminate\Http\Response
     */
    public function edit(MuayThaiClass $muayThaiClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MuayThaiClass  $muayThaiClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MuayThaiClass $muayThaiClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MuayThaiClass  $muayThaiClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(MuayThaiClass $muayThaiClass)
    {
        //
    }
}
