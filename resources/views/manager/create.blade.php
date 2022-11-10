@extends('layouts.main')

@section('content')
    <section>
        <div class="m-8">
            <div class="flex items-center container flex-wrap justify-between">
                <h1 class="text-4xl">เพิ่มคลาสเรียน</h1>
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="bg-gray-300 p-3 rounded-full mx-2 py-2 hover:bg-gray-200">
                        Home
                    </a>
                </div>
            </div>
            <div class="mt-4 overflow-x-auto relative shadow-md sm:rounded">
                <form action="{{ route('manager.create') }}" method="get" enctype="multipart/form-data" class="grid-cols-4 grid gap-4 p-8">
                    @csrf
                    <div class="flex justify-center items-center"><p class="">ครูผู้สอน</p></div>
                    <select type="text" class="rounded-lg" name="teacher" id="teacher">
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                    <div></div>
                    <div></div>
                    <div class="flex justify-center items-center"><p class="">วันที่เปิด</p></div>
                    <input type="date" class="rounded-lg" name="open_date" id="open_date">
                    <div class="flex justify-center items-center"><p class="">วันที่ปิด</p></div>
                    <input type="date" class="rounded-lg" name="close_date" id="close_date">
                    <div class="flex justify-center items-center"><p class="">ราคา</p></div>
                    <input type="number" class="rounded-lg" name="price" id="price">
                    <div class="flex justify-center items-center"><p class="">จำนวนคนที่รับ</p></div>
                    <input type="number" class="rounded-lg" name="max_member" id="max_member">
                    <div class="flex justify-center items-center"><p class="">จำนวนชั่วโมง</p></div>
                    <input type="number" class="rounded-lg" name="hour" id="hour">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div class="text-center mr-20 flex justify-center items-center">
                        <button class="my-2 px-6 py-3 rounded-xl bg-green-400 hover:bg-green-300" type="submit">ยืนยัน</button>
                    </div>
                    <div class="text-center mr-20 flex justify-center items-center">
                        <a href="{{ url('/') }}" class="my-2 px-6 py-3 rounded-xl bg-red-400 hover:bg-red-300" type="submit">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
