<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auction_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile_filter.css') }}">
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
</head>

<body>
    @yield('header')
    <section id="shop_container">
        @yield('name_shop')
        <div class="filter_box">
            <button id="filter_menu">
                <h4>ตัวกรอง</h4>
            </button>
        </div>

        <div class="grid">
            <div class="content1">
                <div class="box">
                    <h2>ตัวกรอง</h2>
                </div>
                <div class="box">
                    <form class="check" action="" id="filter-form">
                        <h4 for="checkbox">ชื่อพระ</h4>
                        <input type="checkbox" id="toggleCheckbox1" class="hidden-checkbox">
                        <label for="toggleCheckbox1">
                            <img src="{{ asset('Component Pic/arrow.png') }}" id="checkboxImage1"
                                onclick="toggleCheckbox()">
                        </label>
                    </form>
                    <div class="toggle" id="toggle-1">
                        <div class="search">
                            <img src="{{ asset('Component Pic/search.webp') }}" alt="">
                            <input type="search" class="search_input" id="searchInput" placeholder="ค้นหา......">
                        </div>
                        <div class="name_list">
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-1" class="check_input_amulet" value="พระกริ่ง">
                                <label for="input_amulet-1" class="checkbox"></label>
                                <span>พระกริ่ง</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-2" class="check_input_amulet" value="พระขุนแผน">
                                <label for="input_amulet-2" class="checkbox"></label>
                                <span>พระขุนแผน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-3" class="check_input_amulet" value="พระนางพญา">
                                <label for="input_amulet-3" class="checkbox"></label>
                                <span>พระนางพญา</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-4" class="check_input_amulet" value="พระปิดตา">
                                <label for="input_amulet-4" class="checkbox"></label>
                                <span>พระปิดตา</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-5" class="check_input_amulet" value="พระพิฆเนศ">
                                <label for="input_amulet-5" class="checkbox"></label>
                                <span>พระพิฆเนศ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-6" class="check_input_amulet "
                                    value="พระพุทธชินราช">
                                <label for="input_amulet-6" class="checkbox"></label>
                                <span>พระพุทธชินราช</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-7" class="check_input_amulet" value="พระสมเด็จ">
                                <label for="input_amulet-7" class="checkbox"></label>
                                <span>พระสมเด็จ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-8" class="check_input_amulet"
                                    value="หลวงปู่ดู่">
                                <label for="input_amulet-8" class="checkbox"></label>
                                <span>หลวงปู่ดู่</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-9" class="check_input_amulet"
                                    value="หลวงปู่โต๊ะ">
                                <label for="input_amulet-9" class="checkbox"></label>
                                <span>หลวงปู่โต๊ะ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-10" class="check_input_amulet"
                                    value="หลวงปู่ทวด">
                                <label for="input_amulet-10" class="checkbox"></label>
                                <span>หลวงปู่ทวด</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-11" class="check_input_amulet"
                                    value="หลวงปู่ทิม">
                                <label for="input_amulet-11" class="checkbox"></label>
                                <span>หลวงปู่ทิม</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-12" class="check_input_amulet"
                                    value="หลวงปู่หมุน">
                                <label for="input_amulet-12" class="checkbox"></label>
                                <span>หลวงปู่หมุน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-13" class="check_input_amulet"
                                    value="หลวงปู่หลิว">
                                <label for="input_amulet-13" class="checkbox"></label>
                                <span>หลวงปู่หลิว</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-14" class="check_input_amulet"
                                    value="หลวงพ่อกวย">
                                <label for="input_amulet-14" class="checkbox"></label>
                                <span>หลวงพ่อกวย</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-15" class="check_input_amulet"
                                    value="หลวงพ่อคูณ">
                                <label for="input_amulet-15" class="checkbox"></label>
                                <span>หลวงพ่อคูณ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-16" class="check_input_amulet"
                                    value="หลวงพ่อเงิน">
                                <label for="input_amulet-16" class="checkbox"></label>
                                <span>หลวงพ่อเงิน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-17" class="check_input_amulet"
                                    value="หลวงพ่อเดิม">
                                <label for="input_amulet-17" class="checkbox"></label>
                                <span>หลวงพ่อเดิม</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-18" class="check_input_amulet"
                                    value="หลวงพ่อรวย">
                                <label for="input_amulet-18" class="checkbox"></label>
                                <span>หลวงพ่อรวย</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-19" class="check_input_amulet"
                                    value="หลวงพ่อโสธร">
                                <label for="input_amulet-19" class="checkbox"></label>
                                <span>หลวงพ่อโสธร</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-20" class="check_input_amulet"
                                    value="อื่นๆ">
                                <label for="input_amulet-20" class="checkbox"></label>
                                <span>อื่นๆ</span>
                            </div>
                            {{-- <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Get the search input element
                                    var searchInput = document.getElementById("searchInput");

                                    // Get all name_amulet elements
                                    var nameAmuletItems = document.querySelectorAll(".name_amulet");

                                    // Add an input event listener to the search input
                                    searchInput.addEventListener("input", function() {
                                        var searchText = searchInput.value.toLowerCase();

                                        nameAmuletItems.forEach(function(item) {
                                            var name = item.querySelector("span").textContent.toLowerCase();

                                            if (name.includes(searchText)) {
                                                item.style.display = "";
                                            } else {
                                                item.style.display = "none";
                                            }
                                        });
                                    });
                                });
                            </script> --}}
                        </div>
                    </div>
                </div>
                <div class="box">
                    <form class="check" action="#">
                        <h4 for="checkbox">อำเภอ</h4>
                        <input type="checkbox" id="toggleCheckbox2" class="hidden-checkbox">
                        <label for="toggleCheckbox2">
                            <img src="{{ asset('Component Pic/arrow.png') }}" id="checkboxImage2"
                                onclick="toggleCheckbox()">
                        </label>
                    </form>
                    <div class="toggle" id="toggle-2">
                        <div class="search">
                            <img src="{{ asset('Component Pic/search.webp') }}" alt="">
                            <input type="search" class="search_input" id="searchInput2" placeholder="ค้นหา......">
                        </div>
                        <div class="name_list">
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-1" class="check_input_district"
                                    value="งาว">
                                <label for="input_province-1" class="checkbox"></label>
                                <span>งาว</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-2" class="check_input_district"
                                    value="วังเหนือ">
                                <label for="input_province-2" class="checkbox"></label>
                                <span>วังเหนือ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-3" class="check_input_district"
                                    value="สบปราบ">
                                <label for="input_province-3" class="checkbox"></label>
                                <span>สบปราบ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-4" class="check_input_district"
                                    value="ห้างฉัตร">
                                <label for="input_province-4" class="checkbox"></label>
                                <span>ห้างฉัตร</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-5" class="check_input_district"
                                    value="เกาะคา">
                                <label for="input_province-5" class="checkbox"></label>
                                <span>เกาะคา</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-6" class="check_input_district"
                                    value="เถิน">
                                <label for="input_province-6" class="checkbox"></label>
                                <span>เถิน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-7" class="check_input_district"
                                    value="เมือง">
                                <label for="input_province-7" class="checkbox"></label>
                                <span>เมือง</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-8" class="check_input_district"
                                    value="เมืองปาน">
                                <label for="input_province-8" class="checkbox"></label>
                                <span>เมืองปาน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-9" class="check_input_district"
                                    value="เสริมงาม">
                                <label for="input_province-9" class="checkbox"></label>
                                <span>เสริมงาม</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-10" class="check_input_district"
                                    value="แจ้ห่ม">
                                <label for="input_province-10" class="checkbox"></label>
                                <span>แจ้ห่ม</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-11" class="check_input_district"
                                    value="แม่ทะ">
                                <label for="input_province-11" class="checkbox"></label>
                                <span>แม่ทะ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-12" class="check_input_district"
                                    value="แม่พริก">
                                <label for="input_province-12" class="checkbox"></label>
                                <span>แม่พริก</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-13" class="check_input_district"
                                    value="แม่เมาะ">
                                <label for="input_province-13" class="checkbox"></label>
                                <span>แม่เมาะ</span>
                            </div>
                        </div>
                    </div>
                    {{-- <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // ค้นหาอีลีเมนต์ของฟิลด์ค้นหา
                            var searchInput2 = document.getElementById("searchInput2");

                            // ค้นหารายการชื่ออำเภอทั้งหมด
                            var nameAmuletItems = document.querySelectorAll(".name_list .name_amulet");

                            // เพิ่ม event listener สำหรับฟิลด์ค้นหา
                            searchInput2.addEventListener("input", function() {
                                var searchText = searchInput2.value.toLowerCase();

                                // ตรวจสอบและกรองรายการตามข้อความค้นหา
                                nameAmuletItems.forEach(function(item) {
                                    var name = item.querySelector("span").textContent.toLowerCase();

                                    if (name.includes(searchText)) {
                                        item.style.display = "";
                                    } else {
                                        item.style.display = "none";
                                    }
                                });
                            });
                        });
                    </script> --}}
                </div>
                <div class="box">
                    <form class="check" action="#">
                        <h4 for="checkbox">ราคา</h4>
                        <input type="checkbox" id="toggleCheckbox3" class="hidden-checkbox">
                        <label for="toggleCheckbox3">
                            <img src="{{ asset('Component Pic/arrow.png') }}" id="checkboxImage3"
                                onclick="toggleCheckbox()">
                        </label>
                    </form>
                    <div class="toggle" id="toggle-3">
                        <div class="price_slider_wrapper">
                            <div class="price-input">
                                <div class="field">
                                    <span>น้อยสุด</span>
                                    <input type="number" name="" class="input-min" value="0"
                                        min="0">
                                </div>
                                <!-- <div class="seperator">-</div> -->
                                <div class="field">
                                    <span>มากสุด</span>
                                    <input type="number" name="" class="input-max" value="10000000"
                                        max="10000000">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <form class="check" action="#">
                        <h4 for="checkbox">เรียงตาม</h4>
                        <input type="checkbox" id="toggleCheckbox4" class="hidden-checkbox">
                        <label for="toggleCheckbox4">
                            <img src="{{ asset('Component Pic/arrow.png') }}" id="checkboxImage4">
                        </label>
                    </form>
                    <div class="toggle" id="toggle-4">
                        <div class="sort">
                            <button class="lowest">Low to High</button>
                        </div>
                        <div class="sort">
                            <button class="highest">High to Low</button>
                        </div>
                        <div class="sort">
                            <button class="newest">New</button>
                        </div>
                        <div class="sort">
                            <button class="oldest">Old</button>
                        </div>
                    </div>
                </div>

            </div>
            @yield('content2')
            <div id="mobile_filter">
                <div class="close_menu">
                    <button id="closeMenuButton_filter"><i class="fa fa-times"></i></button>
                </div>
                <div class="box">
                    <form class="check" action="" id="filter-form">
                        <h4 for="checkbox">ชื่อพระ</h4>
                        <input type="checkbox" id="toggleCheckbox1_mobile" class="hidden-checkbox">
                        <label for="toggleCheckbox1_mobile">
                            <img src="{{ asset('Component Pic/arrow.png') }}" id="checkboxImage1"
                                onclick="toggleCheckbox()">
                        </label>
                    </form>
                    <div class="toggle" id="toggle-1_mobile">
                        <div class="search">
                            <img src="{{ asset('Component Pic/search.webp') }}" alt="">
                            <input type="search" class="search_input" id="searchInput" placeholder="ค้นหา......">
                        </div>
                        <div class="name_list">
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-1" class="check_input_amulet"
                                    value="พระกริ่ง">
                                <label for="input_amulet-1" class="checkbox"></label>
                                <span>พระกริ่ง</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-2" class="check_input_amulet"
                                    value="พระขุนแผน">
                                <label for="input_amulet-2" class="checkbox"></label>
                                <span>พระขุนแผน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-3" class="check_input_amulet"
                                    value="พระนางพญา">
                                <label for="input_amulet-3" class="checkbox"></label>
                                <span>พระนางพญา</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-4" class="check_input_amulet"
                                    value="พระปิดตา">
                                <label for="input_amulet-4" class="checkbox"></label>
                                <span>พระปิดตา</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-5" class="check_input_amulet"
                                    value="พระพิฆเนศ">
                                <label for="input_amulet-5" class="checkbox"></label>
                                <span>พระพิฆเนศ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-6" class="check_input_amulet"
                                    value="พระพุทธชินราช">
                                <label for="input_amulet-6" class="checkbox"></label>
                                <span>พระพุทธชินราช</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-7" class="check_input_amulet"
                                    value="พระสมเด็จ">
                                <label for="input_amulet-7" class="checkbox"></label>
                                <span>พระสมเด็จ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-8" class="check_input_amulet"
                                    value="หลวงปู่ดู่">
                                <label for="input_amulet-8" class="checkbox"></label>
                                <span>หลวงปู่ดู่</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-9" class="check_input_amulet"
                                    value="หลวงปู่โต๊ะ">
                                <label for="input_amulet-9" class="checkbox"></label>
                                <span>หลวงปู่โต๊ะ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-10" class="check_input_amulet"
                                    value="หลวงปู่ทวด">
                                <label for="input_amulet-10" class="checkbox"></label>
                                <span>หลวงปู่ทวด</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-11" class="check_input_amulet"
                                    value="หลวงปู่ทิม">
                                <label for="input_amulet-11" class="checkbox"></label>
                                <span>หลวงปู่ทิม</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-12" class="check_input_amulet"
                                    value="หลวงปู่หมุน">
                                <label for="input_amulet-12" class="checkbox"></label>
                                <span>หลวงปู่หมุน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-13" class="check_input_amulet"
                                    value="หลวงปู่หลิว">
                                <label for="input_amulet-13" class="checkbox"></label>
                                <span>หลวงปู่หลิว</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-14" class="check_input_amulet"
                                    value="หลวงพ่อกวย">
                                <label for="input_amulet-14" class="checkbox"></label>
                                <span>หลวงพ่อกวย</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-15" class="check_input_amulet"
                                    value="หลวงพ่อคูณ">
                                <label for="input_amulet-15" class="checkbox"></label>
                                <span>หลวงพ่อคูณ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-16" class="check_input_amulet"
                                    value="หลวงพ่อเงิน">
                                <label for="input_amulet-16" class="checkbox"></label>
                                <span>หลวงพ่อเงิน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-17" class="check_input_amulet"
                                    value="หลวงพ่อเดิม">
                                <label for="input_amulet-17" class="checkbox"></label>
                                <span>หลวงพ่อเดิม</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-18" class="check_input_amulet"
                                    value="หลวงพ่อรวย">
                                <label for="input_amulet-18" class="checkbox"></label>
                                <span>หลวงพ่อรวย</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-19" class="check_input_amulet"
                                    value="หลวงพ่อโสธร">
                                <label for="input_amulet-19" class="checkbox"></label>
                                <span>หลวงพ่อโสธร</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_amulet-20" class="check_input_amulet"
                                    value="อื่นๆ">
                                <label for="input_amulet-20" class="checkbox"></label>
                                <span>อื่นๆ</span>
                            </div>
                            {{-- <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Get the search input element
                                    var searchInput = document.getElementById("searchInput");

                                    // Get all name_amulet elements
                                    var nameAmuletItems = document.querySelectorAll(".name_amulet");

                                    // Add an input event listener to the search input
                                    searchInput.addEventListener("input", function() {
                                        var searchText = searchInput.value.toLowerCase();

                                        nameAmuletItems.forEach(function(item) {
                                            var name = item.querySelector("span").textContent.toLowerCase();

                                            if (name.includes(searchText)) {
                                                item.style.display = "";
                                            } else {
                                                item.style.display = "none";
                                            }
                                        });
                                    });
                                });
                            </script> --}}
                        </div>
                    </div>
                </div>
                <div class="box">
                    <form class="check" action="#">
                        <h4 for="checkbox">อำเภอ</h4>
                        <input type="checkbox" id="toggleCheckbox2_mobile" class="hidden-checkbox">
                        <label for="toggleCheckbox2_mobile">
                            <img src="{{ asset('Component Pic/arrow.png') }}" id="checkboxImage2"
                                onclick="toggleCheckbox()">
                        </label>
                    </form>
                    <div class="toggle" id="toggle-2_mobile">
                        <div class="search">
                            <img src="{{ asset('Component Pic/search.webp') }}" alt="">
                            <input type="search" class="search_input" id="searchInput2" placeholder="ค้นหา......">
                        </div>
                        <div class="name_list">
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-1" class="check_input_district"
                                    value="งาว">
                                <label for="input_province-1" class="checkbox"></label>
                                <span>งาว</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-2" class="check_input_district"
                                    value="วังเหนือ">
                                <label for="input_province-2" class="checkbox"></label>
                                <span>วังเหนือ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-3" class="check_input_district"
                                    value="สบปราบ">
                                <label for="input_province-3" class="checkbox"></label>
                                <span>สบปราบ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-4" class="check_input_district"
                                    value="ห้างฉัตร">
                                <label for="input_province-4" class="checkbox"></label>
                                <span>ห้างฉัตร</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-5" class="check_input_district"
                                    value="เกาะคา">
                                <label for="input_province-5" class="checkbox"></label>
                                <span>เกาะคา</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-6" class="check_input_district"
                                    value="เถิน">
                                <label for="input_province-6" class="checkbox"></label>
                                <span>เถิน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-7" class="check_input_district"
                                    value="เมือง">
                                <label for="input_province-7" class="checkbox"></label>
                                <span>เมือง</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-8" class="check_input_district"
                                    value="เมืองปาน">
                                <label for="input_province-8" class="checkbox"></label>
                                <span>เมืองปาน</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-9" class="check_input_district"
                                    value="เสริมงาม">
                                <label for="input_province-9" class="checkbox"></label>
                                <span>เสริมงาม</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-10" class="check_input_district"
                                    value="แจ้ห่ม">
                                <label for="input_province-10" class="checkbox"></label>
                                <span>แจ้ห่ม</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-11" class="check_input_district"
                                    value="แม่ทะ">
                                <label for="input_province-11" class="checkbox"></label>
                                <span>แม่ทะ</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-12" class="check_input_district"
                                    value="แม่พริก">
                                <label for="input_province-12" class="checkbox"></label>
                                <span>แม่พริก</span>
                            </div>
                            <div class="name_amulet">
                                <input type="checkbox" id="input_province-13" class="check_input_district"
                                    value="แม่เมาะ">
                                <label for="input_province-13" class="checkbox"></label>
                                <span>แม่เมาะ</span>
                            </div>
                        </div>
                    </div>
                    {{-- <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // ค้นหาอีลีเมนต์ของฟิลด์ค้นหา
                            var searchInput = document.getElementById("searchInput2");

                            // ค้นหารายการชื่ออำเภอทั้งหมด
                            var nameAmuletItems = document.querySelectorAll(".name_list .name_amulet");

                            // เพิ่ม event listener สำหรับฟิลด์ค้นหา
                            searchInput.addEventListener("input", function() {
                                var searchText = searchInput.value.toLowerCase();

                                // ตรวจสอบและกรองรายการตามข้อความค้นหา
                                nameAmuletItems.forEach(function(item) {
                                    var name = item.querySelector("span").textContent.toLowerCase();

                                    if (name.includes(searchText)) {
                                        item.style.display = "";
                                    } else {
                                        item.style.display = "none";
                                    }
                                });
                            });
                        });
                    </script> --}}
                </div>
                <div class="box">
                    <form class="check" action="#">
                        <h4 for="checkbox">ราคา</h4>
                        <input type="checkbox" id="toggleCheckbox3_mobile" class="hidden-checkbox">
                        <label for="toggleCheckbox3_mobile">
                            <img src="{{ asset('Component Pic/arrow.png') }}" id="checkboxImage3"
                                onclick="toggleCheckbox()">
                        </label>
                    </form>
                    <div class="toggle" id="toggle-3_mobile">
                        <div class="price_slider_wrapper">
                            <div class="price-input">
                                <div class="field">
                                    <span>น้อยสุด</span>
                                    <input type="number" name="" class="input-min" value="0"
                                        min="0">
                                </div>
                                <!-- <div class="seperator">-</div> -->
                                <div class="field">
                                    <span>มากสุด</span>
                                    <input type="number" name="" class="input-max" value="10000000"
                                        max="10000000">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <form class="check" action="#">
                        <h4 for="checkbox">เรียงตาม</h4>
                        <input type="checkbox" id="toggleCheckbox4_mobile" class="hidden-checkbox">
                        <label for="toggleCheckbox4_mobile">
                            <img src="{{ asset('Component Pic/arrow.png') }}" id="checkboxImage4">
                        </label>
                    </form>
                    <div class="toggle" id="toggle-4_mobile">
                        <div class="sort">
                            <button class="lowest">Low to High</button>
                        </div>
                        <div class="sort">
                            <button class="highest">High to Low</button>
                        </div>
                        <div class="sort">
                            <button class="newest">New</button>
                        </div>
                        <div class="sort">
                            <button class="oldest">Old</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="footer">
        <div class="contact">
            <p>PORNSAWAN PRAMAN</p>
            <ul>
                <li><a href=""><img src="{{ asset('Component Pic/facebook.webp') }}" alt=""></a></li>
                <li><a href=""><img src="{{ asset('Component Pic/ig.webp') }}" alt=""></a></li>
                <li><a href=""><img src="{{ asset('Component Pic/email.png') }}" alt=""></a></li>
            </ul>
        </div>
        <div class="contact">
            <p>PATTARADON WONGCHAI</p>
            <ul>
                <li><a href=""><img src="{{ asset('Component Pic/facebook.webp') }}" alt=""></a></li>
                <li><a href=""><img src="{{ asset('Component Pic/ig.webp') }}" alt=""></a></li>
                <li><a href=""><img src="{{ asset('Component Pic/email.png') }}" alt=""></a></li>
            </ul>
        </div>
        <div class="contact">
            <p>LAMPANG RAJABHAT UNIVERSITY</p>
            <ul>
                <li><a href=""><img src="{{ asset('Component Pic/facebook.webp') }}" alt=""></a></li>
                <li><a href=""><img src="{{ asset('Component Pic/www.png') }}" alt=""></a></li>
                <li><a href=""><img src="{{ asset('Component Pic/email.png') }}" alt=""></a></li>
            </ul>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="/js/script.js"></script>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var navbarButton = document.getElementById("navbarButton");
        var closeMenuButton = document.getElementById("closeMenuButton");
        var navbar2 = document.getElementById("navbar2");

        navbarButton.addEventListener("click", function() {
            navbar2.classList.add("active");
            document.body.style.overflow = "hidden";
        });

        closeMenuButton.addEventListener("click", function() {
            navbar2.classList.remove("active");
            document.body.style.overflow = "auto";
        });

        var filter_menu_btn = document.getElementById("filter_menu");
        var closeMenuButton_filter = document.getElementById("closeMenuButton_filter");
        var navbar2 = document.getElementById("navbar2");

        filter_menu_btn.addEventListener("click", function() {
            mobile_filter.classList.add("active");
            document.body.style.overflow = "hidden";
        });

        closeMenuButton_filter.addEventListener("click", function() {
            mobile_filter.classList.remove("active");
            document.body.style.overflow = "auto";
        });
    });
</script>


{{-- shop --}}
<script>
    $(document).ready(function() {
        let sortOrder = 'default'; // ตัวแปรเก็บสถานะการจัดเรียง

        // ฟังก์ชันที่ใช้ในการดึงข้อมูลสินค้าจากเซิร์ฟเวอร์
        function loadProducts(selectedGroups, selectedDistricts, minPrice, maxPrice, sortOrder) {
            $.ajax({
                url: '{{ route('product.filter') }}',
                method: 'GET',
                data: {
                    selection_groups: selectedGroups,
                    selection_districts: selectedDistricts,
                    min_price: minPrice,
                    max_price: maxPrice,
                    sort_order: sortOrder // ส่งข้อมูลการจัดเรียงไปยังเซิร์ฟเวอร์
                },
                success: function(response) {
                    console.log('Response:', response); // ตรวจสอบข้อมูลที่ได้รับ
                    var productContainer = $('#product-list');
                    productContainer.empty(); // ล้างข้อมูลเดิม

                    // ตรวจสอบว่า response มีข้อมูลสินค้าหรือไม่
                    if (response.products && Array.isArray(response.products) && response.products
                        .length > 0) {
                        response.products.forEach(function(product) {
                            var fileExtension = product.file_path_1 ? product.file_path_1
                                .split('.').pop() : '';
                            var mediaContent = '';

                            if (fileExtension && ['mp4', 'webm', 'ogg'].includes(
                                    fileExtension)) {
                                mediaContent = '<video width="100%" height="100%">' +
                                    '<source src="/storage/' + product.file_path_1 +
                                    '" type="video/' + fileExtension + '">' +
                                    'Your browser does not support the video tag.' +
                                    '</video>';
                            } else {
                                mediaContent = '<img id="img_item' + product.id +
                                    '" src="/storage/' + (product.file_path_1 ||
                                        'path_to_default_image') +
                                    '" alt="Product Image">';
                            }

                            var productUrl = '{{ route('product.showshop', ':id') }}';
                            productUrl = productUrl.replace(':id', product.id);
                            productContainer.append(
                                '<div class="card">' +
                                '    <div class="box">' +
                                '        <div class="img-box">' +
                                '            <a href="' + productUrl + '">' +
                                '                <button id="item' + product.id +
                                '" class="button-wrapper">' +
                                '                    ' + mediaContent +
                                '                </button>' +
                                '            </a>' +
                                '        </div>' +
                                '        <span><b>' + product.name + '</b></span>' +
                                '        <div class="amount">' +
                                '            <span id="amount-' + product.id + '">' +
                                product.price + '</span>' +
                                '            <span> Bath</span>' +
                                '        </div>' +
                                '    </div>' +
                                '</div>'
                            );
                        });
                    } else {
                        productContainer.append('<p>No products available.</p>');
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }

        // ฟังก์ชันที่จะถูกเรียกเมื่อ checkbox เปลี่ยนสถานะ
        function updateProductList() {
            var selectedGroups = [];
            var selectedDistricts = [];
            var minPrice = $('.input-min').val() || 0;
            var maxPrice = $('.input-max').val() || 10000000;

            // ดึงค่าจาก checkbox ที่ถูกเลือก
            $('.check_input_amulet:checked').each(function() {
                selectedGroups.push($(this).val());
            });

            $('.check_input_district:checked').each(function() {
                selectedDistricts.push($(this).val());
            });

            // เรียกใช้ฟังก์ชัน loadProducts เพื่ออัพเดทข้อมูล
            loadProducts(selectedGroups, selectedDistricts, minPrice, maxPrice, sortOrder);
        }

        $('.sort button').on('click', function() {
            var sortType = $(this).hasClass('lowest') ? 'low_to_high' :
                $(this).hasClass('highest') ? 'high_to_low' :
                $(this).hasClass('oldest') ? 'oldest' :
                $(this).hasClass('newest') ? 'newest' : 'default';

            sortOrder = sortType;
            updateProductList();
        });

        // เพิ่ม event listener สำหรับ input fields ช่วงราคา
        $('.input-min, .input-max').on('change', updateProductList);

        // เพิ่ม event listener สำหรับ checkbox
        $('.check_input_amulet, .check_input_district').on('change', updateProductList);

        // โหลดข้อมูลสินค้าตอนที่หน้าเว็บโหลด
        loadProducts([], [], $('.input-min').val(), $('.input-max').val(), sortOrder);
    });
</script>


{{-- auction --}}
<script>
    $(document).ready(function() {
        let sortOrder = 'default';

        function loadProducts(selectedGroups, selectedDistricts, minPrice, maxPrice, sortOrder) {
            $.ajax({
                url: '{{ route('auction.filter') }}',
                method: 'GET',
                data: {
                    selection_groups: selectedGroups,
                    selection_districts: selectedDistricts,
                    min_price: minPrice,
                    max_price: maxPrice,
                    sort_order: sortOrder
                },
                success: function(response) {
                    var productContainer = $('#product-list2');
                    productContainer.empty();

                    if (response.products && response.products.length > 0) {
                        response.products.forEach(function(product) {
                            var fileExtension = product.file_path_1 ? product.file_path_1
                                .split('.').pop() : '';
                            var mediaContent = '';

                            if (fileExtension && ['mp4', 'webm', 'ogg'].includes(
                                    fileExtension)) {
                                mediaContent =
                                    '<video width="100%" height="100%">' +
                                    '    <source src="/storage/' + product.file_path_1 +
                                    '" type="video/' + fileExtension + '">' +
                                    '    Your browser does not support the video tag.' +
                                    '</video>';
                            } else {
                                mediaContent =
                                    '<img id="img_item' + product.id +
                                    '" src="/storage/' + (product.file_path_1 ||
                                        'path_to_default_image') +
                                    '" alt="Product Image">';
                            }

                            var productUrl = '{{ url('/products/auction') }}/' + product
                                .id;

                            // productContainer.append(
                            //     '<div class="card">' +
                            //     '    <div class="box">' +
                            //     '        <div class="img-box">' +
                            //     '            <a href="' + productUrl + '">' +
                            //     '                <button id="item' + product.id +
                            //     '" class="button-wrapper">' +
                            //     '                    ' + mediaContent +
                            //     '                </button>' +
                            //     '            </a>' +
                            //     '        </div>' +
                            //     '        <span><b>' + product.name + '</b></span>' +
                            //     '        <div class="countdown" data-date="' + product
                            //     .date + '" data-time="' + product.time +
                            //     '" style="color: red; font-style: italic;"></div>' +
                            //     '        <div class="amount">' +
                            //     '            <span id="amount-' + product.id + '">' +
                            //     product.price + '</span>' +
                            //     '            <span> Bath</span>' +
                            //     '        </div>' +
                            //     '    </div>' +
                            //     '</div>'
                            // );
                            productContainer.append(
                                '<div class="card">' +
                                '    <div class="box">' +
                                '        <div class="img-box">' +
                                '            <a href="' + productUrl + '">' +
                                '                <button id="item' + product.id +
                                '" class="button-wrapper">' +
                                '                    ' + mediaContent +
                                '                </button>' +
                                '            </a>' +
                                '        </div>' +
                                '        <span><b>' + product.name + '</b></span>' +
                                '        <div class="countdown" data-date="' + product
                                .date + '" data-time="' + product.time + '"></div>' +
                                '        <div class="amount">' +
                                '            <span id="amount-' + product.id + '">' +
                                product.price + '</span>' +
                                '            <span> Bath</span>' +
                                '        </div>' +
                                '    </div>' +
                                '</div>'
                            );


                        });
                    } else {
                        productContainer.append('<p>No products available.</p>');
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }

        function updateProductList() {
            var selectedGroups = [];
            var selectedDistricts = [];
            var minPrice = $('.input-min').val() || 0;
            var maxPrice = $('.input-max').val() || 10000000;

            $('.check_input_amulet:checked').each(function() {
                selectedGroups.push($(this).val());
            });

            $('.check_input_district:checked').each(function() {
                selectedDistricts.push($(this).val());
            });

            loadProducts(selectedGroups, selectedDistricts, minPrice, maxPrice, sortOrder);
        }

        $('.sort button').on('click', function() {
            var sortType = $(this).hasClass('lowest') ? 'low_to_high' :
                $(this).hasClass('highest') ? 'high_to_low' :
                $(this).hasClass('oldest') ? 'oldest' :
                $(this).hasClass('newest') ? 'newest' : 'default';

            sortOrder = sortType;
            updateProductList();
        });

        $('.input-min, .input-max').on('change', updateProductList);
        $('.check_input_amulet, .check_input_district').on('change', updateProductList);

        loadProducts([], [], $('.input-min').val(), $('.input-max').val(), sortOrder);
    });
</script>


{{-- script for script --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ฟิลด์ค้นหาสำหรับชื่อพระ
        var searchInput = document.getElementById("searchInput");
        var nameAmuletItems = document.querySelectorAll("#toggle-1 .name_amulet");

        searchInput.addEventListener("input", function() {
            var searchText = searchInput.value.toLowerCase();

            nameAmuletItems.forEach(function(item) {
                var name = item.querySelector("span").textContent.toLowerCase();

                if (name.includes(searchText)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });

        // ฟิลด์ค้นหาสำหรับอำเภอ
        var searchInput2 = document.getElementById("searchInput2");
        var districtItems = document.querySelectorAll("#toggle-2 .name_amulet");

        searchInput2.addEventListener("input", function() {
            var searchText = searchInput2.value.toLowerCase();

            districtItems.forEach(function(item) {
                var name = item.querySelector("span").textContent.toLowerCase();

                if (name.includes(searchText)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });
    });
</script>
