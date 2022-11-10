@extends('layouts.main')

@section('content')
    <section>
        <div class="m-8">
            <div class="flex items-center container flex-wrap justify-between">
                <h1 class="text-4xl">จองคลาสเรียนมวยไทย</h1>
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="bg-gray-300 p-3 rounded-full mx-2 py-2 hover:bg-gray-200">
                        ตรวจสอบคลาสเรียน
                    </a>
                    <a href="{{ route('muay_thai_class.show', ['muay_thai_class' => 1]) }}" class="bg-gray-300 p-3 rounded-full mx-2 py-2 hover:bg-gray-200">
                        ตรวจสอบใบจอง
                    </a>
                    <a href="" class="bg-gray-300 p-3 rounded-full mx-2 py-2 hover:bg-gray-200">
                        ใบเสร็จ
                    </a>
                </div>
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
                                {{ $class->user->name }}
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
                                @auth()
                                <div>
                                    <button class="text-white text-sm py-2 px-4 m-3 ml-0.5 rounded-full bg-green-400 hover:bg-green-300"
                                       onclick="showPopup({{ $class }})">
                                        จอง
                                    </button>
                                </div>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                <form action="{{ route('muay_thai_class.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div hidden id="popup">
                        <div id="popup-modal" tabindex="-1"
                             class="shadow-lg overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center flex"
                             aria-modal="true" role="dialog">
                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button"
                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                            data-modal-toggle="popup-modal">
                                        <!-- <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg> -->
                                    </button>
                                    <div class="p-6 text-center">
                                        <!-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> -->
                                        <div id="detail" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                            <div class="form-group">
                                                <label for="idCourse">ID คลาสเรียนมวยไทย</label>
                                                <input type="text" class="form-control" id="idCourse" name="idCourse" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nameTeacher">ชื่อครูผู้สอน</label>
                                                <input type="text" class="form-control" id="nameTeacher" name="nameTeacher" readonly >
                                            </div>
                                            <div class="form-group">
                                                <label for="openDate">วันที่เปิด</label>
                                                <input type="text" class="form-control" id="openDate" name="openDate" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="closeDate">วันที่ปิด</label>
                                                <input type="text" class="form-control" id="closeDate" name="closeDate" readonly >
                                            </div>
                                            <div class="form-group">
                                                <label for="courseHours">จำนวนชั่วโมง</label>
                                                <input type="text" class="form-control" id="courseHours" name="courseHours" readonly >
                                            </div>
                                            <div class="form-group">
                                                <label for="coursePrice">ราคา</label>
                                                <input type="text" class="form-control" id="coursePrice" name="coursePrice" readonly>
                                            </div>
                                        </div>
                                        <button type="submit"
                                                class="text-white bg-green-400 hover:bg-green-300 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            ตกลง
                                        </button>
                                        <button type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                                onclick="hidePopup()">ยกเลิก
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .form-control {
                            border-radius: 9999px;
                            margin-bottom: 3px;
                        }
                    </style>
                    <script>
                        function showPopup(course) {
                            document.getElementById("idCourse").value = course.id;
                            document.getElementById("nameTeacher").value = course.user.name;
                            document.getElementById("openDate").value = course.open_date;
                            document.getElementById("closeDate").value = course.close_date;
                            document.getElementById("courseHours").value = course.total_class_hour;
                            document.getElementById("coursePrice").value = course.price;
                            document.getElementById("popup").hidden = false;
                        }

                        function hidePopup() {
                            document.getElementById("popup").hidden = true;
                        }
                    </script>
                </form>
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
