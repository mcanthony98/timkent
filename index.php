<?php
session_start();
require "includes/connect.php";
include "includes/cart.php";

$pqry = "SELECT * FROM product JOIN category ON product.category_id=category.category_id ORDER BY product_id DESC LIMIT 12";
$pres = $pdo->query($pqry);
?>
<!DOCTYPE html>
<html lang="en">


<!-- molla/index-11.html  22 Nov 2019 09:58:23 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home - Timkent Spares</title>
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
            <div class="intro-slider-container mb-4">
                <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "responsive": {
                            "992": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <div class="intro-slide" style="background-image: url(assets/images/timkent/banner9.png);">
                        <div class="container intro-content">
                            <h3 class="intro-subtitle text-primary">TOP PICKS</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title">Top Quality <br>Mobile Spareparts</h1><!-- End .intro-title -->

                            <a href="products.php" class="btn btn-outline-primary-2">
                                <span>DISCOVER MORE</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" style="background-image: url(assets/images/timkent/banner5.jpg);">
                        <div class="container intro-content">
                            <h3 class="intro-subtitle text-primary">all at 50% off</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">Replacement Screens<br>For all Mobile Phones</h1><!-- End .intro-title -->

                            <a href="category.html" class="btn btn-outline-primary-2 min-width-sm">
                                <span>SHOP NOW</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->
                </div><!-- End .intro-slider owl-carousel owl-simple -->

                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->

            <div class="container">
                <div class="toolbox toolbox-filter">
                    <div class="toolbox-left">
                        <span class="h3">Featured Products</span>

                    </div><!-- End .toolbox-left -->
                    <div class="toolbox-right">
                        <!--<ul class="nav-filter product-filter">
                            <li class="active"><a href="#" data-filter="*">All</a></li>
                            <li><a href="#" data-filter=".furniture">Furniture</a></li>
                            <li><a href="#" data-filter=".lighting">Lighting</a></li>
                            <li><a href="#" data-filter=".accessories">Accessories</a></li>
                            <li><a href="#" data-filter=".sale">Sale</a></li>
                        </ul>-->
                    </div><!-- End .toolbox-right -->
                </div><!-- End .filter-toolbox -->

                <div class="widget-filter-area" id="product-filter-area">
                    <a href="#" class="widget-filter-clear">Clean All</a>

                    <div class="filter-area-wrapper">
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">
                                        Category:
                                    </h3><!-- End .widget-title -->

                                    <div class="filter-items filter-items-count">
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cat-1">
                                                <label class="custom-control-label" for="cat-1">All</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">24</span>
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cat-2">
                                                <label class="custom-control-label" for="cat-2">Furniture</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">3</span>
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cat-3">
                                                <label class="custom-control-label" for="cat-3">Lighting</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">2</span>
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cat-4">
                                                <label class="custom-control-label" for="cat-4">Accessories</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">4</span>
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cat-5">
                                                <label class="custom-control-label" for="cat-5">Sale</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">2</span>
                                        </div><!-- End .filter-item -->
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget -->
                            </div><!-- End .col-sm-6 col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">
                                        Sort by:
                                    </h3><!-- End .widget-title -->

                                    <div class="filter-items">
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" checked id="sort-1" name="sortby">
                                                <label class="custom-control-label" for="sort-1">Default</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="sort-2" name="sortby">
                                                <label class="custom-control-label" for="sort-2">Popularity</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="sort-3" name="sortby">
                                                <label class="custom-control-label" for="sort-3">Average Rating</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="sort-4" name="sortby">
                                                <label class="custom-control-label" for="sort-4">Newness</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="sort-5" name="sortby">
                                                <label class="custom-control-label" for="sort-5">Price: Low to High</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" id="sort-6" name="sortby">
                                                <label class="custom-control-label" for="sort-6">Price: High to Low</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget -->
                            </div><!-- End .col-sm-6 col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">
                                        Colour:
                                    </h3><!-- End .widget-title -->

                                    <div class="filter-colors filter-colors-vertical">
                                        <a href="#" style="background: #b87145;"><span>Brown</span></a>
                                        <a href="#" style="background: #f0c04a;"><span>Yellow</span></a>
                                        <a href="#" style="background: #333333;"><span>Black</span></a>
                                        <a href="#" class="selected" style="background: #cc3333;"><span>Red</span></a>
                                        <a href="#" style="background: #ebebeb;"><span>White</span></a>
                                    </div><!-- End .filter-colors -->
                                </div><!-- End .widget -->
                            </div><!-- End .col-sm-6 col-lg-3 -->

                            <div class="col-sm-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">
                                        Price:
                                    </h3><!-- End .widget-title -->

                                    <div class="filter-price">
                                        <div class="filter-price-text">
                                            Price Range:
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->

                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .filter-price -->
                                </div><!-- End .widget -->
                            </div><!-- End .col-sm-6 col-lg-3 -->
                        </div><!-- End .row -->
                    </div><!-- End .filter-area-wrapper -->
                </div><!-- End #product-filter-area.widget-filter-area -->
                
                <div class="products-container" data-layout="fitRows">


                <?php while($prow=$pres->fetch_assoc()){
                    $imgqry = "SELECT * FROM prod_img WHERE type='0' AND product_id=".$prow['product_id'];
                    $imgres =$pdo->query($imgqry);
                    if($imgres->num_rows == 0){
                        $img = "placeholder.png";
                    }else{
                        $imgrow = $imgres->fetch_assoc();
                        $img = $imgrow['image'];
                    }
                    ?>

                    <div class="product-item <?php echo $prow['category_name'];?> col-6 col-md-4 col-lg-3">
                        <div class="product product-4">
                            <figure class="product-media">
                                <?php if($prow['quantity'] < 1){?>
                                <span class="product-label">Out of stock</span>
                                <?php } ?>
                                <a href="product.php?product=<?php echo $prow['slug'];?>&pid=<?php echo $prow['product_id'];?>">
                                    <img src="products/<?php echo $img;?>" alt="<?php echo $prow['slug'];?>" class="product-image">
                                </a>
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a href="product.php?product=<?php echo $prow['slug'];?>&pid=<?php echo $prow['product_id'];?>"><?php echo $prow['name'];?></a></h3><!-- End .product-title -->


                                <div class="product-price">
                                    Ksh <?php echo number_format($prow['price'], 2);?>
                                </div><!-- End .product-price -->

                                <div class="product-action">
                                    <a href="product.php?product=<?php echo $prow['slug'];?>&pid=<?php echo $prow['product_id'];?>" class="btn-product btn-cart"><span>Add to Cart</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .product-action -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .product-item -->


                <?php } ?>


                    
                </div><!-- End .products-container -->
            </div><!-- End .container -->

            <div class="more-container text-center mt-0 mb-7">
                <a href="category.html" class="btn btn-outline-dark-3 btn-more"><span>more products</span><i class="la la-refresh"></i></a>
            </div><!-- End .more-container -->

            <div class="container">
                <hr class="mt-5 mb-0">
            </div><!-- End .container -->


            <div class="icon-boxes-container mt-2 mb-2 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rocket"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Delivery in 24Hrs</h3><!-- End .icon-box-title -->
                                    <p>Next day delivery</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rotate-left"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">New Weekly Stocks</h3><!-- End .icon-box-title -->
                                    <p>We have all you need</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Best Quality</h3><!-- End .icon-box-title -->
                                    <p>We sell the best in the market</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">24/7 Support</h3><!-- End .icon-box-title -->
                                    <p>Talk to us Today</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .icon-boxes-container -->






            <div class="bg-light-2 pt-6 pb-5 mb-6 mb-lg-8">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 mb-3 mb-lg-0">
                                <h2 class="title">Who We Are</h2><!-- End .title -->
                                <p class="lead text-primary mb-3">We are a leading dealer in mobile phone and laptop spareparts and accessories. We offer the worldclass quality spareparts and services.</p><!-- End .lead text-primary -->
                                <p class="mb-2">We at Timkent care about client satisfaction. We put into consideration what suits the customer best. </p>

                                
                                <h4>Our Services</h4>
                			<div class="accordion accordion-plus" id="accordion-2">
							    <div class="card">
							        <div class="card-header" id="heading2-1">
							            <h2 class="card-title">
							                <a role="button" data-toggle="collapse" href="#collapse2-1" aria-expanded="true" aria-controls="collapse2-1">
							                    Phone Repairs
							                </a>
							            </h2>
							        </div><!-- End .card-header -->
							        <div id="collapse2-1" class="collapse show" aria-labelledby="heading2-1" data-parent="#accordion-2">
							            <div class="card-body">
							                We fix broken phone touchscreens at a very affordable price. Our touchscreens are of superior quality. We can fix all phone brands e.g Infinix, Umdigi, Techno, Huawei, Oukitel, Cubot etc. We also fix phones mouthpieces, cameras, charging etc. Contact Us for more services.
							            </div><!-- End .card-body -->
							        </div><!-- End .collapse -->
							    </div><!-- End .card -->

							    <div class="card">
							        <div class="card-header" id="heading2-2">
							            <h2 class="card-title">
							                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-2" aria-expanded="false" aria-controls="collapse2-2">
							                    Phone Accessories
							                </a>
							            </h2>
							        </div><!-- End .card-header -->
							        <div id="collapse2-2" class="collapse" aria-labelledby="heading2-2" data-parent="#accordion-2">
							            <div class="card-body">
							                We sell a wide range of phone and laptopaccessories such as chargers, earphones, Bluetooth speakers, USB cables, car chargers, screen protectors, smart watches, decorders etc. We sell products from top digital brands such as Oraimo. Talk to us to get the best deals. 
							            </div><!-- End .card-body -->
							        </div><!-- End .collapse -->
							    </div><!-- End .card -->

							    <div class="card">
							        <div class="card-header" id="heading2-3">
							            <h2 class="card-title">
							                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-3" aria-expanded="false" aria-controls="collapse2-3">
							                    Laptop Sales and Repairs
							                </a>
							            </h2>
							        </div><!-- End .card-header -->
							        <div id="collapse2-3" class="collapse" aria-labelledby="heading2-3" data-parent="#accordion-2">
							            <div class="card-body">
							                We sell quality and affordable laptops such as Lenovo, HP, Dell, Acer and Toshiba. We also repair broken laptop screens, hard disks, motherboards etc. Our service are guaranteed.  
							            </div><!-- End .card-body -->
							        </div><!-- End .collapse -->
							    </div><!-- End .card -->

                                <div class="card">
							        <div class="card-header" id="heading2-4">
							            <h2 class="card-title">
							                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse2-3" aria-expanded="false" aria-controls="collapse2-4">
							                    Other Services
							                </a>
							            </h2>
							        </div><!-- End .card-header -->
							        <div id="collapse2-4" class="collapse" aria-labelledby="heading2-4" data-parent="#accordion-2">
							            <div class="card-body">
							                We offer other services such as sale of Faiba lines, sale of phones batteries (both inbuilt and external) etc. Visit our shop for more customized services. We promise to put a smile on your face.  
							            </div><!-- End .card-body -->
							        </div><!-- End .collapse -->
							    </div><!-- End .card -->
							</div><!-- End .accordion -->



                            </div><!-- End .col-lg-5 -->

                            <div class="col-lg-6 offset-lg-1">
                                <div class="about-images">
                                    <img src="assets/images/timkent/banner13.png" alt="" class="about-img-front">
                                    
                                </div><!-- End .about-images -->
                            </div><!-- End .col-lg-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .bg-light-2 pt-6 pb-6 -->

                <hr class="mb-0">
	                <div class="cta bg-image pt-6 pb-7 mb-5" style="background-image: url(assets/images/backgrounds/cta/bg-2.jpg);background-position: center right;">
            			<div class="row justify-content-center">
		            		<div class="col-sm-10 col-md-8 col-lg-6">
		            			<div class="cta-text text-center">
		            				<h3 class="cta-title">Talk to Us Today</h3><!-- End .cta-title -->
			            			<p class="cta-desc">Our support team is ready to help you anytime. Ask your question by clicking below.</p><!-- End .cta-desc -->
							
									<a href="https://wa.me/254704135100?text=" target="_blank" class="btn btn-primary btn-rounded"><span>Talk to US</span><i class="icon-long-arrow-right"></i></a>
		            			</div><!-- End .cta-text -->
		            		</div><!-- End .col-sm-10 col-md-8 col-lg-6 -->
	                	</div><!-- End .row -->
	                </div><!-- End .cta -->

               




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


<!-- molla/index-11.html  22 Nov 2019 09:58:42 GMT -->
</html>