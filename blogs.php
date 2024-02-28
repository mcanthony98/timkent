<?php
session_start();
//require "includes/connect.php";
//include "includes/cart.php";
$cartcount = 0;

?>

<!-- molla/index-11.html  22 Nov 2019 09:58:23 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blogs - Timkent Spares</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/plugins/nouislider/nouislider.css">
    <link rel="stylesheet" href="assets/css/demos/demo-11.css">
</head>

<body>
    <div class="page-wrapper">
        
    <!--Navbar-->
    <?php include "includes/navbar.php";?>

    <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Our Blogs<span>Timkent Blogs</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="blogs.php">Blogs</a></li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    
                	<div class="entry-container" data-layout="fitRows">
                        <div class="entry-item lifestyle shopping col-sm-6 col-lg-4">
                            <article class="entry entry-mask">
                                <figure class="entry-media">
                                    <a href="what-you-should-do-if-you-drop-your-phone-in-water.php">
                                        <img src="assets/images/inwater.jpg" alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">July 12, 2023</a>
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="what-you-should-do-if-you-drop-your-phone-in-water.php">What you should do if you drop your phone in water</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        in <a href="#">Water Damage</a>,
                                        <a href="#">Repair at Home</a>
                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        </div><!-- End .entry-item -->

                        <div class="entry-container" data-layout="fitRows">
                            <div class="entry-item lifestyle shopping col-sm-6 col-lg-4">
                                <article class="entry entry-mask">
                                    <figure class="entry-media">
                                        <a href="top-10-most-common-phone-issues-and-how-to-fix-them-at-home.php">
                                            <img src="assets/images/fix2.png" alt="image desc">
                                        </a>
                                    </figure><!-- End .entry-media -->
    
                                    <div class="entry-body">
                                        <div class="entry-meta">
                                            <a href="#">July 18, 2023</a>
                                        </div><!-- End .entry-meta -->
    
                                        <h2 class="entry-title">
                                            <a href="top-10-most-common-phone-issues-and-how-to-fix-them-at-home.php">Top 10 Most Common Phone Issues and How to Fix Them at Home</a>
                                        </h2><!-- End .entry-title -->
    
                                        <div class="entry-cats">
                                            in <a href="#">DIY</a>,
                                            <a href="#">Repair at Home</a>
                                        </div><!-- End .entry-cats -->
                                    </div><!-- End .entry-body -->
                                </article><!-- End .entry -->
                            </div><!-- End .entry-item -->

                       
                	</div><!-- End .entry-container -->

                    <div class="mb-3"></div><!-- End .mb-3 -->

                    <!--<nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>-->
                </div><!-- End .container -->
            </div><!-- End .page-content -->

      
        <?php include "includes/footer.php";?>

</main><!-- End .main -->



<?php include "includes/mobilenavbar.php";?>
<!-- Plugins JS File -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.hoverIntent.min.js"></script>
<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/superfish.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/wNumb.js"></script>
<script src="assets/js/nouislider.min.js"></script>
<script src="assets/js/bootstrap-input-spinner.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<script src="assets/js/demos/demo-11.js"></script>
</body>


<!-- molla/blog-mask-grid.html  22 Nov 2019 10:04:42 GMT -->
</html>