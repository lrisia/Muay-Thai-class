<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\MuayThaiClass;
use App\Models\BookingClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        $validated = $request->validate([
            'teacher' => ['required'],
            'open_date' =>['required','after:now','before:3month'],
            'close_date' =>['required','after:now','before:6month'],
            'price' => ['required'],
            'max_member' => ['required'],
            'hour' => ['required']
        ]);
        $date_open = Carbon::createFromFormat('Y-m-d',$request->input('open_date'));
        $date_close = Carbon::createFromFormat('Y-m-d',$request->input('close_date'));
        if($date_open->gte($date_close)){
            throw ValidationException::withMessages(['open_date'=> $request->input('close_date'),'close_date' =>$request->input('close_date')]);
        }
        $class = new MuayThaiClass;
        $class->user_id =  $request->get('teacher');
        $class->open_date =  $request->input('open_date');
        $class->close_date =  $request->input('close_date');
        $class->price =  $request->input('price');
        $class->max_member =  $request->input('max_member');
        $class->total_class_hour =  $request->input('hour');
        $class->save();
        return redirect()->route('muay_thai_class.index');
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
