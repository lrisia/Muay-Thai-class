@extends('layouts.main')

@section('content')
    <section>
        <div class="m-8">
            <div class="flex items-center container flex-wrap justify-between">
                <h1 class="text-4xl">คลาสเรียนที่สอน</h1>
            </div>
            <div class="mt-4 overflow-x-auto relative shadow-md sm:rounded">
                <table class="w-full text-left text-gray-60 mr-0">
                    <thead class="text-lg text-gray-700 bg-gray-200">
                        <tr>
                            <th scope="col" class="py-3 px-6">ID</th>
                            <th scope="col" class="py-3 px-6">ชื่อผู้สอน</th>
                            <th scope="col" class="py-3 px-6">วันที่เปิด</th>
                            <th scope="col" class="py-3 px-6">วันที่ปิด</th>
                            <th scope="col" class="py-3 px-6">จำนวนชั่วโมง</th>
                            <th scope="col" class="py-3 px-6">ราคา</th>
                            <th scope="col" class="py-3 px-6">จำนวนคนที่ลงแล้ว</th>
                            <th scope="col" class="py-3 px-6">จำนวนที่เปิดรับ</th>
                            <th scope="col" class="py-3 px-6"></th>
                        </tr>
                    </thead>

                    <tbody class="m-2">
                    @foreach($classes as $class)
                        <tr class="border-t">
                            <td class="py-3 px-6">
                                {{ $class->id }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $class->users[0]->name }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $class->open_date }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $class->close_date }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $class->total_class_hour }}
                            </td>
                            <td class="py-3 px-6">
                                ฿ {{ $class->price }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $class->enrolled_member }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $class->max_member }}
                            </td>
                            <td>
                                <div>
                                    <a href="{{ route('class.attendance', ['id' => $class->id]) }}" class="text-white text-sm py-2 px-4 m-3 ml-0.5 rounded-full bg-green-400 hover:bg-green-300">
                                        เช็คชื่อ
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
{{--            <form>--}}
{{--                <div id="error-msg" class="alert alert-danger">--}}
{{--                    <span></span>--}}
{{--                </div>--}}
{{--                <table id="table" class="table table-bordered">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col"></th>--}}
{{--                        <th scope="col">ID</th>--}}
{{--                        <th scope="col">ครูผู้สอน</th>--}}
{{--                        <th scope="col">ชั่วโมงเรียน</th>--}}
{{--                        <th scope="col">จำนวนสมาชิกในคลาสเรียน</th>--}}
{{--                        <th scope="col">ราคา</th>--}}
{{--                        <th scope="col">วันที่เปิดคลาสเรียน</th>--}}
{{--                        <th scope="col">วันที่ปิดคลาสเรียน</th>--}}
{{--                        <th scope="col">สถานะ</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr data-th-each="class : ${classes}">--}}
{{--                        <td>--}}
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" type="radio" name="muayThaiClassId" id="flexRadioDefault1" required>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        <td>ID</td>--}}
{{--                        <td>ครูผู้สอน</td>--}}
{{--                        <td>ชั่วโมงเรียน</td>--}}
{{--                        <td>จำนวนสมาชิกในคลาสเรียน</td>--}}
{{--                        <td>ราคา</td>--}}
{{--                        <td>วันที่เปิดคลาสเรียน</td>--}}
{{--                        <td>วันที่ปิดคลาสเรียน</td>--}}
{{--                        <td>สถานะ</td>--}}
{{--                    </tr>--}}

{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#bookingDetails">--}}
{{--                    จองคลาส--}}
{{--                </button>--}}
{{--                <div class="modal fade" id="bookingDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">--}}
{{--                    <div class="modal-dialog">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h1 class="modal-title fs-5" id="staticBackdropLabel">ยืนยันการจองคลาสเรียน</h1>--}}
{{--                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">ยกเลิก</button>--}}
{{--                                <button id="submitButton" type="submit" class="btn btn-dark">ยืนยัน</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
    </section>
@endsection
