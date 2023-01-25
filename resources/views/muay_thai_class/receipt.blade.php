@extends('layouts.main')

@section('content')
    <section>
        <div class="m-8">
            <div class="flex items-center container flex-wrap justify-between">
                <h1 class="text-4xl">ตรวจสอบใบจองคลาสเรียน</h1>
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="bg-gray-300 p-3 rounded-full mx-2 py-2 hover:bg-gray-200">
                        ตรวจสอบคลาสเรียน
                    </a>
                    <a href="{{ route('muay_thai_class.show', ['muay_thai_class' => 1]) }}" class="bg-gray-300 p-3 rounded-full mx-2 py-2 hover:bg-gray-200">
                        ตรวจสอบใบจอง
                    </a>
                    <a href="{{ route('class.receipt') }}" class="bg-gray-300 p-3 rounded-full mx-2 py-2 hover:bg-gray-200">
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
                        <th scope="col" class="py-3 px-6">สถานะ</th>
                        <th scope="col" class="py-3 px-6"></th>
                    </tr>
                    </thead>
                    <tbody class="m-2">
                    @foreach($classes as $class)
                        <tr class="border-t">
                            <td class="py-3 px-6">
                                {{ $class->muay_thai_class_id }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $class->MuayThaiClass->user->name }}
                            </td>
                            <td class="py-3 px-6">
                                {{ date('d-m-Y', strtotime($class->MuayThaiClass->open_date)) }}
                            </td>
                            <td class="py-3 px-6">
                                {{ date('d-m-Y', strtotime($class->MuayThaiClass->close_date)) }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $class->MuayThaiClass->total_class_hour }}
                            </td>
                            <td class="py-3 px-6">
                                ฿ {{ $class->MuayThaiClass->price }}
                            </td>
                            <td class="py-3 px-6">
                                ชำระเงินแล้ว
                            </td>
                            <td>
                                <a class="text-white text-sm py-2 px-4 m-3 ml-0.5 rounded-full bg-blue-400 hover:bg-blue-300"
                                    href="{{ route('receipt.show', ['id' => $class->id]) }}">ดูใบเสร็จ</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
