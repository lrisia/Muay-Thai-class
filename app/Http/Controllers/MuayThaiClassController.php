<?php

namespace App\Http\Controllers;

use App\Models\MuayThaiClass;
use App\Models\Post;
use App\Models\Tag;
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
            }
            $classes = $classes->whereNotIn('id', $user->muayThaiClasses->pluck(['id'])->all());
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

        $user_enrolled_class = $user->muayThaiClasses->pluck(['id'])->all();
//        if (empty($user_enrolled_class[0])) unset($user_enrolled_class[0]);
        $user_enrolled_class[] = $request->get('idCourse');
//        dd($user_enrolled_class,  $request->get('idCourse'), $user->muayThaiClasses);
        $user->muayThaiClasses()->sync($user_enrolled_class);
//        $user_in_class = User::get()->pluck(['id'])->all();
//        $user_in_class[] = $user_id;
//        dd($user_in_class);
//        $class->users()->sync($user_in_class);
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
        $classes = User::find($user->id)->muayThaiClasses;
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

    public function attendance(MuayThaiClass $class) {
        $students = User::whereIn('id', $class->users->pluck(['id'])->all());
        return view('teacher.attendance', [
            'students', $students,
            'class', $class
        ]);
    }
}
