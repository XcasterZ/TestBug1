<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/product.css">
    <!-- <link rel="stylesheet" href="css/quantity.scss"> -->
</head>
<body>
    <section id="header">
        <div class="logo">
            <h4 style="color: white; letter-spacing: 2px;">SADUAKPRA</h4>
        </div>

        <div>
            <ul id="navbar">
                <li><a href="{{ route('home') }}">หน้าหลัก</a></li>
                <li><a class="active link" href="{{ route('products.shop') }}">ซื้อพระ</a></li>
                <li><a href="{{ route('products.auction') }}">ประมูลพระ</a></li>
                @guest
                    <li><a href="{{ route('auth.register') }}">สมัครสมาชิก</a></li>
                    <li><a href="{{ route('auth.login') }}">เข้าสู่ระบบ</a></li>
                @else
                    <li><a class="cart_profile" href="cart"><img src="Component Pic/Cart.png" width="30"
                                height="30"></a></li>
                    <li><a class="cart_profile" href="{{ route('profile.edit') }}"><img
                                src="{{ asset(Auth::user()->profile_img ?? 'Profile Pic/default.png') }}" width="30"
                                height="30" style="border-radius: 50%; object-fit: cover;"></a></li>
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
                <a href="{{ route('products.shop') }}"><button class="active_menu">ซื้อพระ</button></a>
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
                    <a href="cart"><button>ตะกร้า</button></a>
                </div>
            @endguest
        </div>
    </section>

    <section class="product">
        <a href="shop.php"><button>
            <i class="fa fa-arrow-left" ></i>back to shop
        </button></a>
        <div class="product_container">
            <div class="image">
                <div class="main_image">
                    <div class="main_content" >
                        <img src="Item/rec01.webp">
                    </div>
                </div>
                <div class="other_image">
                    <div class="other_img" id="media_1">
                        <img src="Item/rec01.webp">
                    </div>
                    <div class="other_img" id="media_2">
                        <img src="Item/rec01.webp">
                    </div>
                    <div class="other_img" id="media_3">
                        <img src="Item/rec02.webp">
                    </div>
                    <div class="other_img" id="media_4">
                        <img src="Item/rec03.webp">
                    </div>
                    <div class="other_img" id="media_5">
                        <video autoplay loop>
                            <source src="Item/file_example_MP4_480_1_5MG.mp4">
                        </video>
                    </div>
                </div>
                <script>
                    
                </script>
            </div>
            <div class="details">
                <h4>Product Name</h4>
                <div class="product_details">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos amet commodi aliquid aperiam, neque illum molestiae, alias harum rerum dicta non nemo aspernatur? Vitae, ab. Quae, doloribus. Ratione, itaque est ipsum, unde, atque quam voluptates error nobis quia asperiores perspiciatis assumenda accusamus dolor nulla earum aliquam corrupti libero! Aliquam quae a placeat consequatur magnam reiciendis perferendis minus deleniti, quasi porro illo et soluta exercitationem nobis maiores non esse, veniam accusantium facere assumenda. Exercitationem eligendi voluptatem vero itaque! Quod quis optio in repellat maxime voluptatem perferendis quaerat vitae minima libero nemo cum ducimus minus temporibus molestias velit, voluptatum distinctio qui praesentium.</p>
                </div>
                <h4>25000 Bath</h4>
                <div class="payment_show">
                    <img src="Component Pic/mobile bank.png" alt="">
                    <img src="Component Pic/cash on delivery.png" alt="">
                    <img src="Component Pic/true money wallet.png" alt="">
                    <img src="Component Pic/Scheduled Pickup.png" alt="">
                </div>
                <div class="qty-input">
                    <input class="product-qty" type="number" name="product-qty" min="0" max="10" value="1">
                </div>
                <div class="addToCart">
                    <button class="addCart">เพิ่มในตะกร้า</button>
                    <button class="addWish"><i class="far fa-heart"></i></button>
                </div>
                <div class="buyNow">
                    <button class="buy_now">ซื้อตอนนี้</button>
                </div>
                <h4>FirstName LastName</h4>
                <div class="product_details">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos amet commodi aliquid aperiam, neque illum molestiae, alias harum rerum dicta non nemo aspernatur? Vitae, ab. Quae, doloribus. Ratione, itaque est ipsum, unde, atque quam voluptates error nobis quia asperiores perspiciatis assumenda accusamus dolor nulla earum aliquam corrupti libero! Aliquam quae a placeat consequatur magnam reiciendis perferendis minus deleniti, quasi porro illo et soluta exercitationem nobis maiores non esse, veniam accusantium facere assumenda. Exercitationem eligendi voluptatem vero itaque! Quod quis optio in repellat maxime voluptatem perferendis quaerat vitae minima libero nemo cum ducimus minus temporibus molestias velit, voluptatum distinctio qui praesentium.</p>
                </div>
                <h4>Email : test@gmail.com</h4>
                <h4>Phone : 0123456789</h4>
                <div class="show_star">
                    <img src="Component Pic/star.png" alt="">
                </div>
                <div class="contact_show">
                    <img src="Component Pic/instagram.png" alt="">
                    <img src="Component Pic/fb.png" alt="">
                    <img src="Component Pic/line.png" alt="">
                </div>
                <div class="addToCart">
                    <button class="chat">แชทกับผู้ขาย</button>
                    <button class="go_profile"><i class="fa fa-user"></i></button>
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
    <script src="/js/script2.js"></script>
    <script src="https://kit.fontawesome.com/d671ca6a52.js" crossorigin="anonymous"></script>

</body>
</html>