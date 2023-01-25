@extends('layouts.main')

@section('content')
    <section class="">
        <div class="mt-32 flex justify-center">
            <h1 class="font-bold text-8xl">Muay Thai Class</h1>
        </div>
        <div class="flex justify-center">
            <p class="mt-16 text-6xl">Hello! Manager</p>
        </div>
        <div class="flex justify-center">
            <p class="mt-16 text-2xl">{{ Auth::user()->name }}</p>
        </div>
        <div class="mt-16 flex justify-center">
            <a href="{{ route('manager.show', ['manager' => 1]) }}" class="mr-20 bg-gray-400 rounded-full py-4 px-8 text-white hover:bg-gray-300">
                เพิ่มคลาสเรียน
            </a>
            <a href="{{ route('manager.index') }}" class="ml-20 bg-gray-700 rounded-full py-4 px-8 text-white hover:bg-gray-600">
                ตรวจสอบคลาสเรียน
            </a>
        </div>
    </section>
@endsection
