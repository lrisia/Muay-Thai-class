<?php

namespace App\Http\Controllers;

use App\Models\BookingClass;
use App\Models\MuayThaiClass;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = BookingClass::where('status', 'in_progress')->get();
        return view('manager.index', [
            'booking' => $booking
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $class = new MuayThaiClass();
        $class->max_member = $request->get('max_member');
        $class->total_class_hour = $request->get('hour');
        $class->open_date = $request->get('open_date');
        $class->close_date = $request->get('close_date');
        $class->price = $request->get('price');
        $class->user_id = $request->get('teacher');
        $class->save();
        return redirect()->route('muay_thai_class.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = User::where('role', "TEACHER")->get();
        return view('manager.create', [
            'teachers' => $teacher
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $book = BookingClass::find($request->get('bookingId'));
        if ($request->get('n') === "false") {
            $book->status = "declined";
            dd($book->muayThaiClass->enrolled_member);
            $book->muayThaiClass->enrolled_member =  $book->muayThaiClass->enrolled_member - 1;
            dd($book->muayThaiClass->enrolled_member);
//            dd($book->muayThaiClass->enrolled_member);
        } else {
            $book->status = "accepted";
        }
        $book->save();
        return redirect()->route('manager.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
