@extends('layouts.main')

@section('content')
    <section>
        <div class="m-8">
            <div class="flex items-center container flex-wrap justify-between">
                <h1 class="text-4xl">จองคลาสเรียนมวยไทย</h1>
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="bg-gray-300 p-3 rounded-full mx-2 py-2 hover:bg-gray-200">
                        Home
                    </a>
                </div>
            </div>
            <div class="mt-4 overflow-x-auto relative shadow-md sm:rounded">
                <table class="w-full text-left text-gray-60 mr-0">
                    <thead class="text-lg text-gray-700 bg-gray-200">
                    <tr>
                        <th scope="col" class="py-3 px-6">เวลาจอง</th>
                        <th scope="col" class="py-3 px-6">ID คลาสเรียน</th>
                        <th scope="col" class="py-3 px-6">ID ใบจองคลาส</th>
                        <th scope="col" class="py-3 px-6">ชื่อผู้ลงทะเบียน</th>
                        <th scope="col" class="py-3 px-6">วันที่เปิด</th>
                        <th scope="col" class="py-3 px-6">วันที่ปิด</th>
                        <th scope="col" class="py-3 px-6">จำนวนชั่วโมง</th>
                        <th scope="col" class="py-3 px-6"></th>
                    </tr>
                    </thead>

                    <tbody class="m-2">
                    @foreach($booking as $book)
                        <tr class="border-t">
                            <td class="py-3 px-6">
                                {{ date('d-m-Y', strtotime($book->date)) }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $book->muay_thai_class_id }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $book->id }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $book->user->name }}
                            </td>
                            <td class="py-3 px-6">
                                {{ date('d-m-Y', strtotime($book->muayThaiClass->open_date)) }}
                            </td>
                            <td class="py-3 px-6">
                                {{ date('d-m-Y', strtotime($book->muayThaiClass->close_date)) }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $book->muayThaiClass->total_class_hour }}
                            </td>
                            <td>
                                @if ($book->status == "in_progress")
                                <div>
                                    <button class="text-white text-sm py-2 px-4 m-3 ml-0.5 rounded-full bg-green-400 hover:bg-green-300"
                                            onclick="showPopup({{ $book }})">
                                        รายะเอียด
                                    </button>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <form action="{{ route('manager.edit', ['manager' => 1]) }}" enctype="multipart/form-data" id="myForm">
                        @csrf
                        <div hidden id="popup">
                            <div id="popup-modal" tabindex="-1"
                                 class="shadow-lg overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center flex"
                                 aria-modal="true" role="dialog">
                                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                onclick="hidePopup()"> X
                                            <!-- <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg> -->
                                        </button>
                                        <div class="p-6 text-center">
                                            <!-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> -->
                                            <div id="detail" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400 grid-cols-2 grid gap-x-10">
                                                <div class="form-group">
                                                    <label for="idBook">ID คลาสเรียน</label>
                                                    <input type="text" class="form-control w-1/2" id="idBook" name="idBook" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="teacher"> ID ผู้สอน </label><br>
                                                    <input type="text" class="form-control w-1/2" id="teacher" name="teacher" readonly >
                                                </div>
                                                <div class="form-group">
                                                    <label for="openDate">วันที่เปิด</label>
                                                    <input type="text" class="form-control w-3/4" id="openDate" name="openDate" readonly >
                                                </div>
                                                <div class="form-group">
                                                    <label for="closeDate">วันที่ปิด</label>
                                                    <input type="text" class="form-control w-3/4" id="closeDate" name="closeDate" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="enrolled">จำนวนคนลง</label>
                                                    <input type="text" class="form-control w-1/2" id="enrolled" name="enrolled" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="max">จำนวนคนรับ</label>
                                                    <input type="text" class="form-control w-1/2" id="max" name="max" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hour">จำนวนชั่วโมง</label>
                                                    <input type="text" class="form-control w-1/2" id="hour" name="hour" readonly >
                                                </div>
                                            </div>
                                            <input type="text" name="bookingId" id="bookingId" hidden>
                                            <input type="text" name="n" id="n" value="yes" hidden>
                                            <button type="submit"
                                                    class="text-white bg-green-400 hover:bg-green-300 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                อนุมัติ
                                            </button>
                                            <button type="button"
                                                    class="text-red-500 bg-white hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                                    onclick="no()">ปฏิเสธ
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
                            function showPopup(book) {
                                console.log(book)
                                const open_date = book.muay_thai_class.open_date.split("-");
                                console.log(open_date);
                                let temp = open_date[0];
                                open_date[0] = open_date[2];
                                open_date[2] = temp;
                                open_date_str = open_date[0]+"-"+open_date[1]+"-"+open_date[2];

                                const close_date = book.muay_thai_class.open_date.split("-");
                                temp = close_date[0];
                                close_date[0] = close_date[2];
                                close_date[2] = temp;
                                close_date_str = close_date[0]+"-"+close_date[1]+"-"+close_date[2];
                                document.getElementById("bookingId").value = book.id;
                                document.getElementById("idBook").value = book.muay_thai_class_id;
                                document.getElementById("openDate").value = open_date_str;
                                document.getElementById("enrolled").value = book.muay_thai_class.enrolled_member;
                                document.getElementById("hour").value = book.muay_thai_class.total_class_hour;
                                document.getElementById("teacher").value = book.muay_thai_class.user_id;
                                document.getElementById("closeDate").value = close_date_str;
                                document.getElementById("max").value = book.muay_thai_class.max_member;
                                document.getElementById("popup").hidden = false;
                            }

                            function hidePopup() {
                                document.getElementById("popup").hidden = true;
                            }

                            function no() {
                                document.getElementById("n").value = "false";
                                document.getElementById("myForm").submit();
                            }
                        </script>
                    </form>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
