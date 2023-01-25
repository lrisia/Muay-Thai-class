<?php

namespace App\Http\Controllers;

use App\Models\BookingClass;
use App\Models\MuayThaiClass;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuayThaiClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = MuayThaiClass::where('status', 'available')->get();
        if (Auth::user() != null) {
            $user = User::find(Auth::user()->id);
            if (Auth::user()->role === "TEACHER") {
//                dd($user->muayThaiClasses->pluck(['id'])->all());
                $classes = MuayThaiClass::whereIn('id', $user->muayThaiClasses->pluck(['id'])->all())->get();
//                dd($classes);
//                $classes = $classes->where('id', $user->muayThaiClasses->pluck(['id'])->all());
                return view('teacher.index', ['classes' => $classes]);
            } else if (Auth::user()->role === "MANAGER") {
                return view('manager.welcome');
            }
            $booking = BookingClass::where('user_id', $user->id)->get();
            $classes = $classes->whereNotIn('id', $booking->pluck(['muay_thai_class_id'])->all());
        }
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
        $user_id = $request->user()->id;
        $user = User::find($user_id);
        $class = MuayThaiClass::find($request->get('idCourse'));
        $class->enrolled_member += 1;
        if ($class->enrolled_member == $class->max_member) $class->status = 'unavailable';
        $class->save();

        $booking = new BookingClass();
        $booking->muay_thai_class_id = $class->id;
        $booking->user_id = $user_id;
        $booking->save();
        return redirect()->route('muay_thai_class.show', ['muay_thai_class' => $user_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MuayThaiClass  $muayThaiClass
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = Auth::user();
        if ($user->role === "MANAGER") return redirect()->route('muay_thai_class.index');
        $classes = BookingClass::where('user_id', $user->id)->where('status', '!=', 'paid')->get();
        return view('muay_thai_class.show', [
            'user' => $user,
            'classes' => $classes
        ]);
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

    /**
     * @param MuayThaiClass $class
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function attendance(MuayThaiClass $class, $id)
    {
        $class = MuayThaiClass::find($id);
        $student_ids = BookingClass::where('muay_thai_class_id', $id)->where('status', 'paid')->get();
        $students = User::whereIn('id', $student_ids->pluck(['user_id'])->all())->get();
        return view('teacher.attendance', [
            'students' => $students,
            'classes' => $class,
        ]);
    }

    public function saveAttendance(Request $request) {
        $class_id = $request->get('class_id');
//        dd($request->all());
        foreach ($request->all() as $key => $value) {
            if (!str_contains($key, 'check')) continue;
            $user_id = explode("_", $key)[1];
            $booking = BookingClass::where('user_id', $user_id)->where('muay_thai_class_id', $class_id)->first();
            $booking->studied_hour += 1;
//            dd($booking->studied_hour);
            if ($booking->studied_hour == $booking->muayThaiClass->total_class_hour) $booking->status = "finish";
            $booking->save();
        }
        return redirect()->route('muay_thai_class.index');
    }

    public function buyCourse(MuayThaiClass $class, $id, Request $request) {
        $booking = BookingClass::find($request->get('id'));
        $booking->status = "paid";
        $booking->save();

        $receipt = new Receipt();
        $receipt->user_id = Auth::user()->id;
//        dd($request->all());
//        dd(BookingClass::where('muay_thai_class_id', $request->get('id'))->where('user_id', Auth::user()->id)->first());
        $receipt->booking_class_id = BookingClass::where('muay_thai_class_id', $request->get('idCourse'))->where('user_id', Auth::user()->id)->first()->id;
        $receipt->save();
        return redirect()->route('class.receipt');
    }

    public function receipt() {
        $classes = BookingClass::where('user_id', Auth::user()->id)->where('status', 'paid')->get();
        return view('muay_thai_class.receipt', [
            'classes' => $classes
        ]);
    }

    public function showReceipt($id) {
        $book = BookingClass::where('id', $id)->first();
        $class = MuayThaiClass::where('id', $book->muay_thai_class_id)->first();
        $receipt = Receipt::where('booking_class_id', $id)->first();
        $price = $this->convert($class->price);
        return view('muay_thai_class.bill', [
            'receipt' => $receipt,
            'class' => $class,
            'book' => $book,
            'price' => $price
        ]);
    }

    function convert($number){
        $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
        $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
        $number = str_replace(",","",$number);
        $number = str_replace(" ","",$number);
        $number = str_replace("บาท","",$number);
        $number = explode(".",$number);
        if(sizeof($number)>2){
            return $number;
        }
        $strlen = strlen($number[0]);
        $convert = '';
        for($i=0;$i<$strlen;$i++){
            $n = substr($number[0], $i,1);
            if($n != 0){
                if($i==($strlen-1) AND $n==1){ $convert .=
                    'เอ็ด'; }
                elseif($i==($strlen-2) AND $n==2){
                    $convert .= 'ยี่'; }
                elseif($i==($strlen-2) AND $n==1){
                    $convert .= ''; }
                else{ $convert .= $txtnum1[$n]; }
                $convert .= $txtnum2[$strlen-$i-1];
            }
        }
        $convert .= 'บาทถ้วน';
        return $convert;
    }
}
