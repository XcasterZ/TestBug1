<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/product_card.css')}}">
    <link rel="stylesheet" href="{{asset('css/profle.css')}}">
    <link rel="stylesheet" href="{{asset('css/mobile_filter.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script>
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style> 
    <style>
        .file-info {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }
    </style>

</head>

<body>
    
    <section id="header">
        <div class="logo">
            <h4 style="color: white; letter-spacing: 2px;">SADUAKPRA</h4>
        </div>

        <div>
            <ul id="navbar">
                <li><a href="{{ route('home') }}">หน้าหลัก</a></li>
                <li><a href="{{ route('products.shop') }}">ซื้อพระ</a></li>
                <li><a href="{{ route('products.auction') }}">ประมูลพระ</a></li>
                @guest
                    <li><a href="{{ route('auth.register') }}">สมัครสมาชิก</a></li>
                    <li><a href="{{ route('auth.login') }}">เข้าสู่ระบบ</a></li>
                @else
                    <li><a class="cart_profile" href="{{ route('cart.show') }}"><img src="{{asset('Component Pic/Cart.png')}}" width="30"
                                height="30"></a></li>
                    <li><a class="cart_profile" href="{{ route('profile.edit') }}"><img
                                src="{{ asset(Auth::user()->profile_img ?? 'Profile Pic/default.png') }}" width="30"
                                height="30" style="border-radius: 50%; object-fit: cover;"></a></li>
                    <!-- Logout Form -->
                    {{-- <form action="{{ route('logout') }}" method="POST" class="hide-on-small-screen">
                        @csrf
                        <button type="submit">Logout</button>
                    </form> --}}
                @endguest
                <button id="navbarButton"><i class="fa fa-bars"></i></button>
            </ul>
        </div>
        <div id="navbar2">
            <div class="close_menu">
                <button id="closeMenuButton"><i class="fa fa-times"></i></button>
            </div>
            @auth
                <div class="profile_mobile">
                    <a class="cart_profile" href="{{ route('profile.edit') }}"><img
                            src="{{ asset(Auth::user()->profile_img ?? 'Profile Pic/default.png') }}" width="80"
                            height="80" style="border-radius: 50%; object-fit: cover;"></a>
                </div>
            @endauth
            <div class="box_menu">
                <a href="{{ route('home') }}"><button>หน้าหลัก</button></a>
            </div>
            <div class="box_menu">
                <a href="{{ route('products.shop') }}"><button>ซื้อพระ</button></a>
            </div>
            <div class="box_menu">
                <a href="{{ route('products.auction') }}"><button>ประมูลพระ</button></a>
            </div>
            @guest
                <div class="box_menu">
                    <a href="{{ route('auth.register') }}"><button>สมัครสมาชิก</button></a>
                </div>
                <div class="box_menu">
                    <a href="{{ route('auth.login') }}"><button>เข้าสู่ระบบ</button></a>
                </div>
            @else
                <div class="box_menu">
                    <a href="{{ route('cart.show') }}"><button>ตะกร้า</button></a>
                </div>
                
            @endguest
        </div>

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
            });
        </script>
    </section>

    <section class="container">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

        <div class="grid">
            <div class="profile_content1">
                <div class="user_img">
                    <div class="profile_img">
                        <label class="-label" for="file">
                            <span class="glyphicon glyphicon-camera"></span>
                            <span>Change Image</span>
                        </label>
                        <input id="file" type="file" name="profile_img" onchange="loadFile(event)"
                            accept=".jpeg,.jpg,.png,.gif,.svg" />
                        <img src="{{ asset(Auth::user()->profile_img ?? 'Profile Pic/default.png') }}" id="output"
                            class="profile-circle" />

                    </div>
                    <h4>
                        @if (Auth::user()->first_name && Auth::user()->last_name)
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        @else
                            {{ Auth::user()->username }}
                        @endif
                    </h4>
                    <div class="show_star" style="pointer-events: none;">
                        <p>
                            <span class="star-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <label for="rate-{{ $i }}" style="--i:{{ $i }}">
                                        <i class="fa-solid fa-star" style="color: {{ $i <= $averageRating ? '#faec1b' : '#d3d3d3' }}; font-size: 24px;"></i>
                                    </label>
                                @endfor
                            </span>
                        </p>
                    </div>
                    <p class="file-info">Supported file types: JPEG, PNG, JPG, GIF, SVG.</p>

                </div>
                @yield('profile_menu')
            </div>
            @yield('content2')
        </div>
    </section>

    <section id="footer">
        <div class="contact">
            <p>PORNSAWAN PRAMAN</p>
            <ul>
                <li><a href=""><img src="{{asset('Component Pic/facebook.webp')}}" alt=""></a></li>
                <li><a href=""><img src="{{asset('Component Pic/ig.webp')}}" alt=""></a></li>
                <li><a href=""><img src="{{asset('Component Pic/email.png')}}" alt=""></a></li>
            </ul>
        </div>
        <div class="contact">
            <p>PATTARADON WONGCHAI</p>
            <ul>
                <li><a href=""><img src="{{asset('Component Pic/facebook.webp')}}" alt=""></a></li>
                <li><a href=""><img src="{{asset('Component Pic/ig.webp')}}" alt=""></a></li>
                <li><a href=""><img src="{{asset('Component Pic/email.png')}}" alt=""></a></li>
            </ul>
        </div>
        <div class="contact">
            <p>LAMPANG RAJABHAT UNIVERSITY</p>
            <ul>
                <li><a href=""><img src="{{asset('Component Pic/facebook.webp')}}" alt=""></a></li>
                <li><a href=""><img src="{{asset('Component Pic/www.png')}}" alt=""></a></li>
                <li><a href=""><img src="{{asset('Component Pic/email.png')}}" alt=""></a></li>
            </ul>
        </div>
    </section>

    <script>
        function loadFile(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);

            var formData = new FormData();
            formData.append('profile_img', event.target.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route('profile.updateProfileImg') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.success);
                        if (data.profile_img) {
                            output.src = '{{ asset('') }}' + data.profile_img;
                        }
                    } else {
                        alert('Error uploading profile image');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Error uploading profile image');
                });
        }
    </script>

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
    <script src="/js/script.js"></script>
    <script src="/js/script2.js"></script>
    <script src="https://kit.fontawesome.com/d671ca6a52.js" crossorigin="anonymous"></script>
    <script>
        
    </script>
</body>

</html>
