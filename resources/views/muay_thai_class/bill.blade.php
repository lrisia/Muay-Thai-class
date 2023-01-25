@extends('layouts.main')

@section('content')
    <div class="flex items-end justify-end space-x-3 my-2 pt-8">
        <button class="mr-8 px-4 py-2 text-sm bg-gray-300 font-bold rounded hover:bg-gray-400" onclick="printDiv('printThis')">Print</button>
    </div>
    <section class="mt-8" id="printThis">
        <div class="flex items-center justify-center">
            <div class="w-4/5 bg-white shadow-lg mt-10">
                <div class="flex justify-center p-4">
                    <div class="flex items-center">
                        <h1 class="text-3xl font-bold mx-2">ใบเสร็จ</h1>
                    </div>
                </div>
                <hr class="border-black border-4">
{{--                <div class="w-full h-0.5 bg-[#80b319]"></div>--}}
                <div class="grid grid-cols-2 justify-between p-4 ml-6">
                    <p class="font-bold">รหัสใบเสร็จ: {{ $receipt->id }}</p>
                    <p class="font-bold">ชื่อสมาชิก: {{ $receipt->user->name }}</p>
                    <p class="font-bold">วันที่ออกใบเสร็จ: {{ date('d-m-Y', strtotime($receipt->date)) }}</p>
                    <div></div>
                    <p class="font-bold">รหัสใบจองคลาส: {{ $receipt->book_class_id }}</p>
                    <div></div>
                    <p class="font-bold">รหัสคลาสเรียนมวยไทย: {{ $class->id }}</p>
                    <div></div>
                    <p class="font-bold">จำนวนชั่วโมงที่เรียนแล้ว: {{ $book->studied_hour }}</p>
                    <div></div>
                    <p class="font-bold">วันที่เปิดคลาสเรียน: {{ date('d-m-Y', strtotime($class->open_date)) }}</p>
                    <div></div>
                    <p class="font-bold">วันที่ปิดคลาสเรียน: {{ date('d-m-Y', strtotime($class->close_date)) }}</p>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <p class="font-bold">ราคารวมทั้้งสิ้น {{ number_format($class->price) }} บาท</p>
                    <div></div>
                    <div></div>
                    <div></div>
                    <p class="font-bold">{{ $price }}</p>
                </div>
                <div class="flex justify-center p-4">
                    <div class="border-b border-gray-200 shadow">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
