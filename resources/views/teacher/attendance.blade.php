@extends('layouts.main')

@section('content')
    <section>
        <form action="{{ route('class.check') }}">
        <div class="m-8">
            <div class="flex items-center container flex-wrap justify-between">
                <h1 class="text-4xl">เช็คชื่อ</h1>
            </div>
            <div class="mt-4 overflow-x-auto relative shadow-md sm:rounded">
                <table class="w-full text-left text-gray-60 mr-0">
                    <thead class="text-lg text-gray-700 bg-gray-200">
                    <tr>
                        <th scope="col" class="py-3 px-6">ID</th>
                        <th scope="col" class="py-3 px-6">ชื่อผู้เรียน</th>
                        <th scope="col" class="py-3 px-6">จำนวนชั่วโมงทั้งหมด</th>
                        <th scope="col" class="py-3 px-6">จำนวนชั่วโมงที่เหลือ</th>
                        <th scope="col" class="py-3 px-6">เข้าเรียน</th>
                    </tr>
                    </thead>

                    <tbody class="m-2">
                    @foreach ($students as $student)
                        <tr class="border-t">
                            <td class="py-3 px-6">
                                {{ $student->id }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $student->name }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $classes->total_class_hour }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $classes->total_class_hour - $classes->bookingClasses[0]->studied_hour }}
                            </td>
                            <td>
                                <div>
                                    <input id="check" name="" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                </div>
                                <script>
                                    var count = {{ $student->id }};
                                    document.getElementById("check").setAttribute("name", "check_" + count);
                                    document.getElementById("check").id = "check_" + count;
                                </script>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-end mr-8">
            <button type="submit" class="rounded-lg bg-gray-300 px-4 py-2 hover:bg-gray-200">เสร็จสิ้น</button>
            <input hidden type="number" value="{{ $classes->id }}" name="class_id">
        </div>
        </form>
    </section>
@endsection
