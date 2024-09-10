<!-- footer start -->
<footer class="footer-sm-space">
    <div class="main-footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-contact">
                        <div class="brand-logo">
                            <a href="index.php" class="footer-logo">
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon">
                                        <use class="fill-color" xlink:href="assets/svg/icons.svg#logo"></use>
                                    </svg>
                                    <span class="greenway fw-bolder fs-2">GreenWay</span>
                                </div>
                            </a>
                        </div>
                        <ul class="contact-lists">
                            <li>
                                    <span>
                                        <b>phone:</b> <span class="font-light">+94 76 070 7418</span>
                                    </span>
                            </li>
                            <li>
                                    <span>
                                        <b>Address:</b>
                                        <span class="font-light"> 116/2, Thalagahawela,Mugunuwatawana, Chilaw, Sri Lanka</span>
                                    </span>
                            </li>
                            <li>
                                    <span>
                                        <b>Email:</b>
                                        <span class="font-light"
                                              style="text-transform: lowercase;">info@greenway.com</span>
                                    </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-links">
                        <div class="footer-title">
                            <h3>About us</h3>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li>
                                    <a href="index.php" class="font-dark">Home</a>
                                </li>
                                <li>
                                    <a href="shop.php" class="font-dark">Shop</a>
                                </li>
                                <li>
                                    <a href="about-us.html" class="font-dark">About Us</a>
                                </li>
                                <li>
                                    <a href="shop.php" class="font-dark">Blog</a>
                                </li>
                                <li>
                                    <a href="shop.php" class="font-dark">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--TODO: change categories-->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-links">
                        <div class="footer-title">
                            <h3>New Categories</h3>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <?php
                                $categoryRs = MySQL::search("SELECT * FROM category LIMIT 5");
                                while ($categoryData = $categoryRs->fetch_assoc()) {
                                    ?>
                                    <li>
                                        <a href="javascript:void(0)" class="font-dark"><?=  $categoryData['category'] ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-links">
                        <div class="footer-title">
                            <h3>Get Help</h3>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li>
                                    <a href="user-dashboard.php" class="font-dark">Your Orders</a>
                                </li>
                                <li>
                                    <a href="user-dashboard.php" class="font-dark">Your Account</a>
                                </li>
                                <li>
                                    <a href="order-tracking.html" class="font-dark">Track Orders</a>
                                </li>
                                <li>
                                    <a href="wishlist.php" class="font-dark">Your Wishlist</a>
                                </li>
                                <li>
                                    <a href="faq.html" class="font-dark">Shopping FAQs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6 d-none d-sm-block">
                    <div class="footer-newsletter">
                        <h3>Got Qustion ? Call Us 24/7</h3>
                        <div class="footer-number">
                            <div class="footer-number-image">
                                <img src="assets/images/shoes/other/headphone.png"
                                     class="img-fluid blur-up lazyload" alt="">
                            </div>

                            <div class="footer-number-container">
                                <h3>+94 75 765 4310</h3>
                            </div>
                        </div>

                        <div class="footer-details">
                            <p class="font-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo ab
                                dolorem nulla
                                impedit saepe esse et? Ea, totam recusandae doloribus ipsa esse voluptate quis nisi?
                                Voluptate.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-6">
                    <ul>
                        <li class="font-dark">We accept:</li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="assets/images/payment-icon/1.jpg" class="img-fluid blur-up lazyload"
                                     alt="payment icon"></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="assets/images/payment-icon/2.jpg" class="img-fluid blur-up lazyload"
                                     alt="payment icon"></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="assets/images/payment-icon/3.jpg" class="img-fluid blur-up lazyload"
                                     alt="payment icon"></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="assets/images/payment-icon/4.jpg" class="img-fluid blur-up lazyload"
                                     alt="payment icon"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <p class="mb-0 font-dark">All Rights Reserved By GreenWay© @ 2022</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->