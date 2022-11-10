<form action="{{ url('/') }}" method="get">
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
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="idCourse">ID คลาสเรียนมวยไทย</label>
                                                <input type="text" class="form-control" id="idCourse" disabled value="<?=$row['id'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="nameTeacher">ชื่อครูผู้สอน</label>
                                                <input type="text" class="form-control" id="nameTeacher" disabled value="<?=$row['id'];?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="openDate">วันที่เปิด</label>
                                                <input type="text" class="form-control" id="openDate" disabled value="<?=$row['id'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="closeDate">วันที่ปิด</label>
                                                <input type="text" class="form-control" id="closeDate" disabled value="<?=$row['id'];?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="courseHours">จำนวนชั่วโมง</label>
                                                <input type="text" class="form-control" id="courseHours" disabled value="<?=$row['id'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="coursePrice">ราคา</label>
                                                <input type="text" class="form-control" id="coursePrice" disabled value="<?=$row['id'];?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                                class="text-white bg-green-400 hover:bg-green-300 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
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
    <script>
        function showPopup(course) {
            document.getElementById("detail").innerHTML = "ต้องการจองคลาสเรียนมวย ID: " + course.id + " ชื่อผู้สอน: " + course.users[0].name + " เริ่มเรียนวันที่: " + course.open_date + " จำนวน " + course.total_class_hour + " ชั่วโมง ราคา " + course.price + " บาท";
            document.getElementById("popup").hidden = false;
        }

        function hidePopup() {
            document.getElementById("popup").hidden = true;
        }
    </script>
</form>
